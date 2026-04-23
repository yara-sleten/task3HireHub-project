<?php
namespace App\Services;
use Illuminate\Support\Facades\DB;
use App\Models\FreelancerProfile;

class FreelancerService
{
    public function getAll($request)
{
    return FreelancerProfile::query()
        ->with(['user:id,name,email', 'skills'])

        ->withCount([
            'offers as projects_count' => function ($q) {
                $q->where('status', 'accepted');
            },
            'reviews'
        ])

        ->withAvg('reviews', 'rating')

        ->when($request->verified, fn($q) => $q->where('is_verified', true))
        ->when($request->available, fn($q) => $q->where('availability', 'available'))
        ->when($request->top_rated, fn($q) =>
            $q->orderByDesc('reviews_avg_rating')
        )

        ->latest()
        ->paginate(10);
}

    public function getById($id)
{
    return FreelancerProfile::with([
            'user:id,name,email',
            'skills',
            'offers.project'
        ])
        ->withCount([
            'offers as projects_count' => function ($q) {
                $q->where('status', 'accepted');
            },
            'reviews'
        ])
        ->withAvg('reviews', 'rating')
        ->findOrFail($id);
}

public function update($id, $data)
{
    $user = auth()->user();
    $profile = FreelancerProfile::findOrFail($id);

    if ($user->role !== 'freelancer') {
        abort(403, 'Only freelancers can update profile');
    }

    if ($profile->user_id !== $user->id) {
        abort(403, 'You can only update your own profile');
    }

    if (!$profile->is_verified) {
        abort(403, 'Profile must be verified');
    }

    $profile->update([
        'bio' => $data['bio'] ?? $profile->bio,
        'hourly_rate' => $data['hourly_rate'] ?? $profile->hourly_rate,
        'phone' => $data['phone'] ?? $profile->phone,
        'availability' => $data['availability'] ?? $profile->availability,
        'portfolio_url' => $data['portfolio_url'] ?? $profile->portfolio_url,
        'experience_years' => $data['experience_years'] ?? $profile->experience_years,
    ]);

    if (isset($data['skills'])) {
        $syncData = [];

        foreach ($data['skills'] as $skill) {
    $syncData[$skill['skill_id']] = [
        'years_of_experience' => $skill['years_experience'] ?? 0
    ];
}

        $profile->skills()->sync($syncData);
    }

    return $profile->load(['user', 'skills']);
}


public function createProfile($data)
{
    $user = auth()->user();

    if ($user->role !== 'freelancer') {
        abort(403, 'Only freelancers can create profile');
    }

    return DB::transaction(function () use ($data, $user) {

        $freelancer = FreelancerProfile::create([
            'user_id' => $user->id,
            'bio' => $data['bio'] ?? null,
            'hourly_rate' => $data['hourly_rate'] ?? null,
            'phone' => $data['phone'] ?? null,
            'avatar' => $data['avatar'] ?? null,
            'availability' => $data['availability'] ?? 'available',
            'portfolio_url' => $data['portfolio_url'] ?? null,
            'experience_years' => $data['experience_years'] ?? 0,
            'is_verified' => false,
        ]);

        if (!empty($data['skills'])) {
            $syncData = [];

            foreach ($data['skills'] as $skill) {
                $syncData[$skill['id']] = [
                    'years_of_experience' => $skill['years_of_experience'] ?? 0
                ];
            }

            $freelancer->skills()->sync($syncData);
        }

        return $freelancer->load(['user', 'skills']);
    });
}
}
<?php
namespace App\Services;
use App\Notifications\NewOfferNotification;
use App\Models\Offer;
use App\Models\Project;

class OfferService
{
    public function getAll($request)
    {
        return Offer::with([
                'project:id,title,budget_amount,status',
                'freelancer:id,name,email'
            ])
            ->when($request->status, fn($q) =>
                $q->where('status', $request->status)
            )
            ->latest()
            ->get();
    }

    public function getById($id)
    {
        return Offer::with([
                'project',
                'freelancer:id,name,email'
            ])->findOrFail($id);
    }

 public function store($data)
{
    $user = auth()->user();

    $profile = $user->freelancerProfile;

    if ($user->role !== 'freelancer' || !$profile || !$profile->is_verified) {
        abort(403, 'Only verified freelancers can submit offers');
    }

    $project = Project::with('client')->findOrFail($data['project_id']);

    if ($project->status !== 'open') {
        abort(403, 'You cannot apply to this project');
    }

    $exists = Offer::where('project_id', $project->id)
        ->where('freelancer_id', $user->id)
        ->exists();

    if ($exists) {
        abort(403, 'You already applied to this project');
    }

    $offer = Offer::create([
        'project_id' => $project->id,
        'freelancer_id' => $user->id,
        'proposed_price' => $data['proposed_price'],
        'delivery_time' => $data['delivery_time'],
        'cover_letter' => $data['cover_letter'] ?? null,
        'status' => 'pending',
    ]);

    if ($project->client) {
        $project->client->notify(new NewOfferNotification($offer));
    }

    return $offer;
}
    public function update($offer, $data)
{
    $user = auth()->user();

    if ($user->role !== 'client') {
        abort(403, 'Only client can update offer status');
    }

    if ($offer->project->client_id !== $user->id) {
        abort(403, 'Not your project');
    }

    $offer->update([
        'status' => $data['status']
    ]);

    if ($offer->status === 'accepted') {
        Offer::where('project_id', $offer->project_id)
            ->where('id', '!=', $offer->id)
            ->update(['status' => 'rejected']);
    }

    return $offer;
}

    public function delete($offer)
    {
        return $offer->delete();
    }

    public function pending()
    {
        return Offer::where('status', 'pending')->get();
    }

    public function accepted()
    {
        return Offer::where('status', 'accepted')->get();
    }

    public function rejected()
    {
        return Offer::where('status', 'rejected')->get();
    }

   

}
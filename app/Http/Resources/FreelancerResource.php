<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FreelancerResource extends JsonResource
{
public function toArray($request)
{
    return [
        'id' => $this->id,

        'user' => [
            'id' => $this->user->id,
            'name' => $this->user->name,
            'email' => $this->user->email,
        ],

        'bio' => $this->bio,
        'hourly_rate' => $this->hourly_rate,
        'phone' => $this->phone,
        'avatar' => $this->avatar_url,
        'availability' => $this->availability,
        'is_verified' => $this->is_verified,
        'portfolio_url' => $this->portfolio_url,
        'experience_years' => $this->experience_years,

      
        'projects_count' => $this->projects_count ?? 0,
        'reviews_count' => $this->reviews_count ?? 0,
        'avg_rating' => $this->reviews_avg_rating ?? null,

      
        'skills' => $this->skills->map(function ($skill) {
            return [
                'id' => $skill->id,
                'name' => $skill->name,
                'years_of_experience' => $skill->pivot->years_of_experience
            ];
        }),
        'projects' => $this->whenLoaded('offers', function () {
            return $this->offers
                ->where('status', 'accepted')
                ->map(function ($offer) {
                    return [
                        'id' => $offer->project->id,
                        'title' => $offer->project->title,
                        'budget' => $offer->project->budget_amount,
                        'status' => $offer->project->status,
                    ];
                });
        }),
    ];
}}
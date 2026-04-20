<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,

            'project' => [
                'id' => $this->project->id,
                'title' => $this->project->title,
                'budget' => $this->project->budget_amount,
                'status' => $this->project->status,
            ],

            'freelancer' => [
                'id' => $this->freelancer->id,
                'name' => $this->freelancer->user->name ?? null,
            ],

            'proposed_price' => $this->proposed_price,
            'delivery_time' => $this->delivery_time,
            'cover_letter' => $this->cover_letter,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ];
    }
}


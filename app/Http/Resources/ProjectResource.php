<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\OfferResource;
class ProjectResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'budget' => $this->budget,

            'client' => [
                'id' => $this->client->id ?? null,
                'name' => $this->client->name ?? null,
            ],
            'tags' => $this->tags->pluck('name'),
            'offers_count' => $this->offers_count,
            'avg_rating' => $this->reviews_avg_rating ?? 0,
            'offers' => OfferResource::collection($this->whenLoaded('offers')),
            'attachments' => $this->whenLoaded('attachments'),
            'reviews' => $this->whenLoaded('reviews'),
        ];
    }
}
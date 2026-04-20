<?php
namespace App\Services;

use App\Models\Review;

class ReviewService
{
    public function getAll($request)
    {
        return Review::with([
                'client:id,name',
                'freelancer:id,name'
            ])
            ->when($request->freelancer_id, function ($q) use ($request) {
                $q->where('freelancer_id', $request->freelancer_id);
            })
            ->when($request->client_id, function ($q) use ($request) {
                $q->where('client_id', $request->client_id);
            })
            ->latest()
            ->get();
    }

    public function getById($id)
    {
        return Review::with([
                'client:id,name',
                'freelancer:id,name'
            ])
            ->findOrFail($id);
    }

    public function create($data)
    {
        return Review::create($data);
    }

    public function update($review, $data)
    {
        $review->update($data);
        return $review;
    }

    public function delete($review)
    {
        return $review->delete();
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Services\ReviewService;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;

class ReviewController extends Controller
{
    public function __construct(
        private ReviewService $service
    ) {}

    public function index(Request $request)
    {
        return response()->json(
            $this->service->getAll($request)
        );
    }

    public function show($id)
    {
        return response()->json(
            $this->service->getById($id)
        );
    }

    public function store(StoreReviewRequest $request)
    {
        return response()->json(
            $this->service->create($request->validated()),
            201
        );
    }

    public function update(UpdateReviewRequest $request, $id)
    {
        $review = Review::findOrFail($id);

        return response()->json(
            $this->service->update($review, $request->validated())
        );
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        $this->service->delete($review);

        return response()->json([
            'message' => 'Review deleted successfully'
        ]);
    }
}
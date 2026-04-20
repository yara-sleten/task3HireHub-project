<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\Services\OfferService;
use App\Http\Resources\OfferResource;

class OfferController extends Controller
{
    public function __construct(private OfferService $service) {}

    public function index(Request $request)
    {
        return OfferResource::collection(
            $this->service->getAll($request)
        );
    }

    public function show($id)
    {
        return new OfferResource(
            $this->service->getById($id)
        );
    }

    public function store(StoreOfferRequest $request)
    {
        $offer = $this->service->store($request->validated());

        return response()->json($offer);
    }

    public function update(UpdateOfferRequest $request, Offer $offer)
    {
        $updated = $this->service->update($offer, $request->validated());

        return new OfferResource($updated);
    }

    public function destroy(Offer $offer)
    {
        $this->service->delete($offer);

        return response()->json([
            'message' => 'Offer deleted successfully'
        ]);
    }

    public function pending()
    {
        return OfferResource::collection($this->service->pending());
    }

    public function accepted()
    {
        return OfferResource::collection($this->service->accepted());
    }

    public function rejected()
    {
        return OfferResource::collection($this->service->rejected());
    }
}
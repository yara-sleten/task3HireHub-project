<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use App\Services\CityService;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;

class CityController extends Controller
{
    public function __construct(
        private CityService $service
    ) {}

    public function index()
    {
        return response()->json(
            $this->service->getAll()
        );
    }

    public function show($id)
    {
        return response()->json(
            $this->service->getById($id)
        );
    }

    public function store(StoreCityRequest $request)
    {
        return response()->json(
            $this->service->create($request->validated()),
            201
        );
    }

    public function update(UpdateCityRequest $request, $id)
    {
        $city = City::findOrFail($id);

        return response()->json(
            $this->service->update($city, $request->validated())
        );
    }

    public function destroy($id)
    {
        $city = City::findOrFail($id);

        $this->service->delete($city);

        return response()->json([
            'message' => 'City deleted'
        ]);
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Services\CountryService;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;

class CountryController extends Controller
{
    public function __construct(
        private CountryService $service
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

    public function store(StoreCountryRequest $request)
    {
        return response()->json(
            $this->service->create($request->validated()),
            201
        );
    }

    public function update(UpdateCountryRequest $request, $id)
    {
        $country = Country::findOrFail($id);

        return response()->json(
            $this->service->update($country, $request->validated())
        );
    }

    public function destroy($id)
    {
        $country = Country::findOrFail($id);

        $this->service->delete($country);

        return response()->json([
            'message' => 'Country deleted successfully'
        ]);
    }
}
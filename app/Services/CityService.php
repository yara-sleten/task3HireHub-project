<?php
namespace App\Services;

use App\Models\City;

class CityService
{
    public function getAll()
    {
        return City::with('country:id,name')->get();
    }

    public function getById($id)
    {
        return City::with('country:id,name')
            ->with('users:id,name,city_id')
            ->findOrFail($id);
    }

    public function create($data)
    {
        return City::create($data);
    }

    public function update($city, $data)
    {
        $city->update($data);
        return $city;
    }

    public function delete($city)
    {
        return $city->delete();
    }
}
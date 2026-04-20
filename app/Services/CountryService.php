<?php
namespace App\Services;

use App\Models\Country;

class CountryService
{
    public function getAll()
    {
        return Country::with('cities:id,name,country_id')->get();
    }

    public function getById($id)
    {
        return Country::with('cities:id,name,country_id')
            ->findOrFail($id);
    }

    public function create($data)
    {
        return Country::create($data);
    }

    public function update($country, $data)
    {
        $country->update($data);
        return $country;
    }

    public function delete($country)
    {
        return $country->delete();
    }
}
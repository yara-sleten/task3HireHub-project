<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getAll()
    {
        return User::with('freelancerProfile')->get();
    }

    public function getById($id)
    {
        return User::with([
            'freelancerProfile',
            'reviews',
            'offers'
        ])->findOrFail($id);
    }

    public function store($data)
    {
        $data['password'] = Hash::make($data['password']);

        return User::create($data);
    }

    public function update($user, $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return $user;
    }

    public function delete($user)
    {
        return $user->delete();
    }
}
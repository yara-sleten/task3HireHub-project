<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function __construct(
        private UserService $service
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

    public function store(StoreUserRequest $request)
    {
        $user = $this->service->store($request->validated());

        return response()->json($user, 201);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->service->getById($id);

        return response()->json(
            $this->service->update($user, $request->validated())
        );
    }

    public function destroy($id)
    {
        $user = $this->service->getById($id);

        $this->service->delete($user);

        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }
}

<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(
        private AuthService $service
    ) {}

    public function register(RegisterRequest $request)
    {
        $result = $this->service->register($request->validated());

        return response()->json($result);
    }

    public function login(LoginRequest $request)
    {
        $result = $this->service->login($request->validated());

        if (!$result) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        return response()->json($result);
    }
}
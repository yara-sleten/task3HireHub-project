<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FreelancerVerified
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user || !$user->freelancerProfile || !$user->freelancerProfile->is_verified) {
            return response()->json([
                'message' => 'Freelancer not verified'
            ], 403);
        }

        return $next($request);
    }
}
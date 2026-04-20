<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureFreelancerVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
  public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        if ($user->role === 'freelancer') {

            if (!$user->freelancerProfile || !$user->freelancerProfile->is_verified) {
                return response()->json([
                    'message' => 'Your freelancer profile is not verified yet'
                ], 403);
            }
        }

        return $next($request);
    }
}

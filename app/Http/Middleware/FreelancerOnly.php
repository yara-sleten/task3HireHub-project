<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FreelancerOnly
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user || $user->role !== 'freelancer') {
            return response()->json([
                'message' => 'Only freelancers can perform this action'
            ], 403);
        }

        return $next($request);
    }
}
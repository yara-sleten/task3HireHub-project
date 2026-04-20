<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClientOnly
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user || $user->role !== 'client') {
            return response()->json([
                'message' => 'Only clients can perform this action'
            ], 403);
        }

        return $next($request);
    }
}
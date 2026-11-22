<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminUser
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $adminEmail = config('portfolio.admin.email');

        if ($user === null) {
            return response()->json(['message' => 'Silakan masuk sebagai admin.'], 401);
        }

        if (
            ! is_string($adminEmail)
            || ! hash_equals(mb_strtolower($adminEmail), mb_strtolower($user->email))
        ) {
            return response()->json(['message' => 'Akses khusus admin.'], 403);
        }

        return $next($request);
    }
}

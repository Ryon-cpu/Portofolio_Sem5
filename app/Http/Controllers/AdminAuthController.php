<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AdminAuthController extends Controller
{
    public function session(): JsonResponse
    {
        $user = Auth::user();
        $adminEmail = config('portfolio.admin.email');
        $isAdmin = $user !== null
            && is_string($adminEmail)
            && hash_equals(mb_strtolower($adminEmail), mb_strtolower($user->email));

        if ($isAdmin) {
            $this->setAvailability(true);
        }

        return response()->json([
            'authenticated' => $isAdmin,
            'user' => $isAdmin ? ['name' => $user->name, 'email' => $user->email] : null,
        ]);
    }

    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ]);
        $adminEmail = config('portfolio.admin.email');

        if (
            ! is_string($adminEmail)
            || ! hash_equals(mb_strtolower($adminEmail), mb_strtolower($credentials['email']))
            || ! Auth::attempt($credentials)
        ) {
            return response()->json(['message' => 'Email atau kata sandi tidak sesuai.'], 422);
        }

        $request->session()->regenerate();
        $this->setAvailability(true);

        return response()->json([
            'authenticated' => true,
            'user' => ['name' => Auth::user()->name, 'email' => Auth::user()->email],
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $this->setAvailability(false);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['authenticated' => false]);
    }

    public function presence(): JsonResponse
    {
        $this->setAvailability(true);

        return response()->json(['online' => true]);
    }

    private function setAvailability(bool $isOnline): void
    {
        if ($isOnline) {
            Cache::put('portfolio-admin-online', true, now()->addMinutes(2));
            return;
        }

        Cache::forget('portfolio-admin-online');
    }
}

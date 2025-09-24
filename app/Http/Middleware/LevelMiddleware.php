<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LevelMiddleware
{
    public function handle($request, Closure $next, $level)
    {
        $user = Auth::user();
        $levels = config('auth.level');
        // Gunakan id_level (bukan level) untuk pengecekan
        $userLevel = $user->id_level ?? $user->level ?? null;
        if ($user && isset($levels[$level])) {
            if (is_array($userLevel)) {
                if (in_array($levels[$level], $userLevel)) {
                    return $next($request);
                }
            } else {
                if ($userLevel == $levels[$level]) {
                    return $next($request);
                }
            }
        }
        abort(403, 'Unauthorized.');
    }
}

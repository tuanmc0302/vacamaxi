<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminTwoFactorAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('admin.login');
        }

        if (! $user->isTwoFactorEnabled()) {
            return $next($request);
        }

        if ($request->session()->get('admin_two_factor_passed') === true) {
            return $next($request);
        }

        return redirect()->route('admin.two-factor.challenge');
    }
}

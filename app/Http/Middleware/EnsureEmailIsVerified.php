<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureEmailIsVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (
            $request->user() &&
            !$request->user()->hasVerifiedEmail() &&
            !$request->is('email/*', 'logout')
        ) {
            return $request->expectsJson()
                ? abort(403, '您的邮箱还未激活认证')
                : redirect()->route('verification.notice');
        }

        return $next($request);
    }
}

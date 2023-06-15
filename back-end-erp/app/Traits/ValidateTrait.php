<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;

trait ValidateTrait
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::guard('api')->check()) {
                throw new AuthenticationException('Unauthenticated.');
            }

            $token = $request->bearerToken();

            if (!$token) {
                throw new AuthenticationException('Invalid token.');
            }

            $expiration = strtotime($token->expires_at);

            if ($expiration < now()->timestamp) {
                return redirect('/login');
            }

            return $next($request);
        });
    }
}

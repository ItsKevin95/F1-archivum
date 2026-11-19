<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Fortify;


class InertiaRedirectServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LoginResponse::class, fn () => new class implements LoginResponse {
            public function toResponse($request)
            {
                return Inertia::location(redirect()->intended(Fortify::redirects('login')));
            }
        });

        $this->app->singleton(RegisterResponse::class, fn () => new class implements RegisterResponse {
            public function toResponse($request)
            {
                return Inertia::location(redirect()->intended(Fortify::redirects('register')));
            }
        });

        $this->app->singleton(LogoutResponse::class, fn () => new class implements LogoutResponse {
            public function toResponse($request)
            {
                return Inertia::location(redirect(Fortify::redirects('logout', '/')));
            }
        });
    }
}

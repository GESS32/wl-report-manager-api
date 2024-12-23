<?php

declare(strict_types=1);

namespace App\Providers;

use Architecture\Domains\Auth\Repositories\AuthRepositoryInterface;
use Architecture\Infrastructure\Auth\AuthUserRepositoryJwtEloquent;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class AuthInfrastructureProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(AuthRepositoryInterface::class, AuthUserRepositoryJwtEloquent::class);
    }

    public function provides(): array
    {
        return [
            AuthRepositoryInterface::class,
        ];
    }
}

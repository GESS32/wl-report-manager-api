<?php

declare(strict_types=1);

namespace App\Providers;

use Architecture\Domains\Auth\Factories\AuthEntityFactoryStrict;
use Architecture\Domains\Auth\Factories\AuthEntityFactoryInterface;
use Architecture\Domains\Auth\Repositories\AuthRepositoryInterface;
use Architecture\Infrastructure\Persistence\Repositories\AuthUserRepositoryJwt;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class DomainAuthProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(AuthRepositoryInterface::class, AuthUserRepositoryJwt::class);
        $this->app->bind(AuthEntityFactoryInterface::class, AuthEntityFactoryStrict::class);
    }

    public function provides(): array
    {
        return [
            AuthRepositoryInterface::class,
            AuthEntityFactoryInterface::class,
        ];
    }
}

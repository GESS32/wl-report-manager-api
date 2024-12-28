<?php

declare(strict_types=1);

namespace App\Providers;

use Architecture\Infrastructure\Adapters\AuthAdapterInterface;
use Architecture\Infrastructure\Adapters\AuthAdapterLaravel;
use Architecture\Infrastructure\Adapters\JwtAdapterInterface;
use Architecture\Infrastructure\Adapters\JwtAdapterLaravelTymon;
use Architecture\Infrastructure\Adapters\UuidAdapterInterface;
use Architecture\Infrastructure\Adapters\UuidRamseyAdapter;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class InfrastructureServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(JwtAdapterInterface::class, JwtAdapterLaravelTymon::class);
        $this->app->bind(UuidAdapterInterface::class, UuidRamseyAdapter::class);
        $this->app->bind(AuthAdapterInterface::class, AuthAdapterLaravel::class);
    }

    public function provides(): array
    {
        return [
            JwtAdapterInterface::class,
            UuidAdapterInterface::class,
            AuthAdapterInterface::class,
        ];
    }
}

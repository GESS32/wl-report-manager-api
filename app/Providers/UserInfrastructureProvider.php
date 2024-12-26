<?php

declare(strict_types=1);

namespace App\Providers;

use Architecture\Domains\User\Factories\UserIdentifierFactoryInterface;
use Architecture\Domains\User\Localizations\LocalizationInterface;
use Architecture\Domains\User\Repositories\UserRepositoryInterface;
use Architecture\Infrastructure\User\LocalizationLaravel;
use Architecture\Infrastructure\User\UserIdentifierFactoryUuid4;
use Architecture\Infrastructure\User\UserRepositoryEloquent;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class UserInfrastructureProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepositoryEloquent::class);
        $this->app->bind(UserIdentifierFactoryInterface::class, UserIdentifierFactoryUuid4::class);
        $this->app->bind(LocalizationInterface::class, LocalizationLaravel::class);
    }

    public function provides(): array
    {
        return [
            UserRepositoryInterface::class,
            UserIdentifierFactoryInterface::class,
            LocalizationInterface::class,
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Providers;

use Architecture\Domains\User\Factories\IdentifierFactoryFromProvider;
use Architecture\Domains\User\Factories\IdentifierFactoryInterface;
use Architecture\Domains\User\Factories\UserFactoryFromArray;
use Architecture\Domains\User\Factories\UserFactoryInterface;
use Architecture\Domains\User\Services\LocalizationServiceInterface;
use Architecture\Domains\User\Providers\IdentifierProviderInterface;
use Architecture\Domains\User\Repositories\UserRepositoryInterface;
use Architecture\Infrastructure\Providers\UserIdentifierProviderUuid;
use Architecture\Infrastructure\User\LocalizationServiceLaravel;
use Architecture\Infrastructure\Persistence\Repositories\UserRepositoryEloquent;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class DomainUserProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepositoryEloquent::class);
        $this->app->bind(LocalizationServiceInterface::class, LocalizationServiceLaravel::class);
        $this->app->bind(IdentifierProviderInterface::class, UserIdentifierProviderUuid::class);
        $this->app->bind(IdentifierFactoryInterface::class, IdentifierFactoryFromProvider::class);
        $this->app->bind(UserFactoryInterface::class, UserFactoryFromArray::class);
    }

    public function provides(): array
    {
        return [
            UserRepositoryInterface::class,
            LocalizationServiceInterface::class,
            IdentifierProviderInterface::class,
            IdentifierFactoryInterface::class,
            UserFactoryInterface::class,
        ];
    }
}

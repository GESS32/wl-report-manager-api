<?php

declare(strict_types=1);

namespace App\Providers;

use Architecture\Application\Auth\GetUserService;
use Architecture\Domains\Auth\Repositories\AuthRepositoryInterface;
use Architecture\Domains\User\Entities\UserEntity;
use Architecture\Infrastructure\Auth\AuthUserRepositoryJwtEloquent;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AuthInfrastructureProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(AuthRepositoryInterface::class, AuthUserRepositoryJwtEloquent::class);

        $this->app->singleton(UserEntity::class, function (): UserEntity {
            /** @var Request $request */
            $request = $this->app->make('request');

            /** @var GetUserService $service */
            $service = $this->app->make(GetUserService::class);

            return $service->execute($request->bearerToken());
        });
    }

    public function provides(): array
    {
        return [
            AuthRepositoryInterface::class,
            UserEntity::class,
        ];
    }
}

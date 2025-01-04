<?php

declare(strict_types=1);

namespace App\Providers;

use Architecture\Application\User\Auth\FindHandler;
use Architecture\Application\User\Auth\FindQuery;
use Architecture\Domains\User\Entities\UserEntity;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class ApplicationUserProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->singleton(UserEntity::class, function (): UserEntity {
            /** @var Request $request */
            $request = $this->app->make('request');

            /** @var FindHandler $handler */
            $handler = $this->app->make(FindHandler::class);

            return $handler->execute(new FindQuery($request->bearerToken()));
        });
    }

    public function provides(): array
    {
        return [
            UserEntity::class,
        ];
    }
}

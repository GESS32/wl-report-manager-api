<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Adapters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AuthAdapterLaravel implements AuthAdapterInterface
{
    public function login(array $credentials): void
    {
        Auth::attempt($credentials);
    }

    public function logout(): void
    {
        Auth::logout();
    }

    public function user(): ?array
    {
        /** @var Model $user */
        $user = Auth::user();

        return $user?->toArray();
    }
}

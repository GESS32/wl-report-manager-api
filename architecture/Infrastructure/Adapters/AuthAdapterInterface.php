<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Adapters;

interface AuthAdapterInterface
{
    public function login(array $credentials): void;

    public function logout(): void;

    public function user(): ?array;
}

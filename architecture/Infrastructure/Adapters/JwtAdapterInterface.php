<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Adapters;

interface JwtAdapterInterface
{
    public function getToken(): ?string;

    public function setToken(string $token): void;

    public function attempt(array $credentials): ?string;

    public function authenticate(string $token): ?array;

    public function refresh(string $token): ?string;
}

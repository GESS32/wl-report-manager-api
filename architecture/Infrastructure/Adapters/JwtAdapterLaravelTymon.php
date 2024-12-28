<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Adapters;

use Tymon\JWTAuth\Facades\JWTAuth;

readonly class JwtAdapterLaravelTymon implements JwtAdapterInterface
{
    /** @var \Tymon\JWTAuth\JWT|\Tymon\JWTAuth\JWTAuth */
    private mixed $jwt;

    public function __construct()
    {
        $this->jwt = JWTAuth::getFacadeRoot();
    }

    public function getToken(): ?string
    {
        return $this->jwt->getToken();
    }

    public function setToken(string $token): void
    {
        $this->jwt->setToken($token);
    }

    public function attempt(array $credentials): ?string
    {
        return $this->jwt->attempt($credentials);
    }

    public function authenticate(string $token): ?array
    {
        $user = $this->jwt->authenticate();
        return $user?->toArray();
    }

    public function refresh(string $token): ?string
    {
        return $this->jwt->refresh();
    }
}

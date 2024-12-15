<?php

declare(strict_types=1);

namespace Architecture\Domains\Auth\Repositories;

use Architecture\Domains\Auth\Entities\AuthEntity;

interface AuthRepositoryInterface
{
    public function login(string $nickname, string $password): ?AuthEntity;

    public function signIn(AuthEntity $entity): ?string;

    public function getToken(): ?string;

    public function refreshToken(): ?string;

    public function get(string $token): ?AuthEntity;

    public function save(AuthEntity $entity): void;

    public function destroy(AuthEntity $entity): void;

    public function logout(): void;
}

<?php

declare(strict_types=1);

namespace Architecture\Application\Auth;

use Architecture\Domains\Auth\Repositories\AuthRepositoryInterface;
use Architecture\Domains\User\Entities\UserEntity;
use Architecture\Domains\User\Repositories\UserRepositoryInterface;
use Architecture\Domains\User\ValueObjects\Identifier;
use Exception;

readonly class GetUserService
{
    public function __construct(
        private AuthRepositoryInterface $authRepository,
        private UserRepositoryInterface $userRepository
    ) {}

    public function execute(string $token): ?UserEntity
    {
        $auth = $this->authRepository->get($token);
        $user = null;

        try {
            $user = $this->userRepository->find(new Identifier($auth->id));
        } catch (Exception) {}

        return $user;
    }
}

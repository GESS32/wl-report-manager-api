<?php

declare(strict_types=1);

namespace Architecture\Application\User\Auth;

use Architecture\Domains\Auth\Repositories\AuthRepositoryInterface;
use Architecture\Domains\User\Entities\UserEntity;
use Architecture\Domains\User\Repositories\UserRepositoryInterface;
use Architecture\Domains\User\ValueObjects\Identifier;
use Throwable;

readonly class FindHandler
{
    public function __construct(
        private AuthRepositoryInterface $authRepository,
        private UserRepositoryInterface $userRepository
    ) {}

    public function execute(FindQuery $query): ?UserEntity
    {
        $auth = $this->authRepository->get($query->token);
        $user = null;

        try {
            $user = $this->userRepository->find(new Identifier($auth->id));
        } catch (Throwable) {}

        return $user;
    }
}

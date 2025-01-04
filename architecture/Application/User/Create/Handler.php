<?php

declare(strict_types=1);

namespace Architecture\Application\User\Create;

use Architecture\Domains\User\Entities\UserEntity;
use Architecture\Domains\User\Factories\IdentifierFactoryInterface;
use Architecture\Domains\User\Factories\UserFactoryInterface;
use Architecture\Domains\User\Repositories\UserRepositoryInterface;
use Throwable;

readonly class Handler
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private IdentifierFactoryInterface $identifierFactory,
        private UserFactoryInterface $userFactory
    ) {}

    /**
     * @throws Throwable
     */
    public function execute(Command $request): UserEntity
    {
        $user = $this->userFactory->make([
            'uuid' => $this->identifierFactory->make(),
            ...$request->toArray()
        ]);

        $this->repository->store($user);

        return $user;
    }
}

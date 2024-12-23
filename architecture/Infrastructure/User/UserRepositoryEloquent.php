<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\User;

use Architecture\Domains\User\ValueObjects\Identifier;
use Architecture\Domains\User\Entities\UserEntity;
use Architecture\Domains\User\Repositories\UserRepositoryInterface;

class UserRepositoryEloquent implements UserRepositoryInterface
{
    public function find(Identifier $id): ?UserEntity
    {
        // TODO: Implement find() method.
        return null;
    }

    public function store(UserEntity $entity): void
    {
        // TODO: Implement store() method.
    }

    public function update(UserEntity $entity): void
    {
        // TODO: Implement update() method.
    }

    public function delete(UserEntity $entity): void
    {
        // TODO: Implement delete() method.
    }
}

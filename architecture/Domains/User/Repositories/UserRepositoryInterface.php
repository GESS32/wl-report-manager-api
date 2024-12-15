<?php

declare(strict_types=1);

namespace Architecture\Domains\User\Repositories;

use Architecture\Domains\User\ValueObjects\Identifier;
use Architecture\Domains\User\Entities\UserEntity;

interface UserRepositoryInterface
{
    public function find(Identifier $id): ?UserEntity;

    public function store(UserEntity $entity): void;

    public function update(UserEntity $entity): void;

    public function delete(UserEntity $entity): void;
}

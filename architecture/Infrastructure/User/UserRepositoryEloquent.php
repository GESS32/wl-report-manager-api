<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\User;

use App\Models\User;
use Architecture\Domains\User\ValueObjects\Identifier;
use Architecture\Domains\User\Entities\UserEntity;
use Architecture\Domains\User\Repositories\UserRepositoryInterface;
use Exception;

readonly class UserRepositoryEloquent implements UserRepositoryInterface
{
    public function __construct(private UserFactoryEloquent $factory) {}

    /**
     * @throws Exception
     */
    public function find(Identifier $id): ?UserEntity
    {
        $user = User::query()->where('uuid', $id->value)->first();

        if ($user) {
            $user = $this->factory->make($user);
        }

        return $user;
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

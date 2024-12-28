<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Persistence\Repositories;

use App\Models\User;
use Architecture\Domains\Auth\Entities\AuthEntity;
use Architecture\Domains\Auth\Factories\AuthEntityFactoryFromArray;
use Architecture\Domains\Auth\Repositories\AuthRepositoryInterface;
use Architecture\Infrastructure\Adapters\AuthAdapterInterface;
use Architecture\Infrastructure\Adapters\JwtAdapterInterface;
use Illuminate\Support\Facades\Auth;
use Throwable;

readonly class AuthUserRepositoryJwtEloquent implements AuthRepositoryInterface
{
    public function __construct(
        private AuthEntityFactoryFromArray $factory,
        private AuthAdapterInterface $auth,
        private JwtAdapterInterface $jwt,
    ) {}

    /**
     * @throws Throwable
     */
    public function login(string $nickname, string $password): ?AuthEntity
    {
        $entity = null;
        $token = $this->jwt->attempt(['nickname' => $nickname, 'password' => $password]);

        if ($token) {
            /** @var User $user */
            $user = Auth::user();

            $entity = $this->factory->make([
                'uuid' => $user->uuid,
                'nickname' => $user->nickname,
                'password' => $user->password,
                'permissions' => $user->permissions,
            ]);
        }

        return $entity;
    }

    public function signIn(AuthEntity $entity): ?string
    {
        return $this->jwt->attempt([
            'nickname' => $entity->nickname->value,
            'password' => $entity->password->value
        ]);
    }

    public function getToken(): ?string
    {
        return $this->jwt->getToken();
    }

    public function refreshToken(string $token): ?string
    {
        return $this->jwt->refresh($token);
    }

    /**
     * @throws Throwable
     */
    public function get(string $token): ?AuthEntity
    {
        $this->jwt->setToken($token);

        $entity = $this->jwt->authenticate($token);

        return $entity ? $this->factory->make($entity) : null;
    }

    public function save(AuthEntity $entity): void
    {
        User::query()
            ->where('uuid', '=', $entity->id)
            ->update([
                'nickname' => $entity->nickname->value,
                'password' => $entity->password->value,
                'permissions' => $entity->permissions->all(),
            ]);
    }

    public function logout(): void
    {
        $this->auth->logout();
    }

    public function destroy(AuthEntity $entity): void
    {
        User::query()
            ->where('uuid', '=', $entity->id)
            ->update([
                'nickname' => null,
                'password' => null,
                'permissions' => [],
            ]);
    }
}

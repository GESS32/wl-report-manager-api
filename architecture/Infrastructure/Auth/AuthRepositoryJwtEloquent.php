<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Auth;

use App\Models\User;
use Architecture\Domains\Auth\Entities\AuthEntity;
use Architecture\Domains\Auth\Exceptions\NicknameFormatException;
use Architecture\Domains\Auth\Exceptions\NicknameLenException;
use Architecture\Domains\Auth\Exceptions\PasswordFormatException;
use Architecture\Domains\Auth\Exceptions\PasswordLenException;
use Architecture\Domains\Auth\Repositories\AuthRepositoryInterface;
use Architecture\Domains\Auth\ValueObjects\Nickname;
use Architecture\Domains\Auth\ValueObjects\Password;
use Architecture\Domains\Auth\ValueObjects\Permission;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthRepositoryJwtEloquent implements AuthRepositoryInterface
{
    /** @var \Tymon\JWTAuth\JWT|\Tymon\JWTAuth\JWTAuth */
    private mixed $jwt;

    public function __construct()
    {
        $this->jwt = JWTAuth::getFacadeRoot();
    }

    /**
     * @throws NicknameFormatException|NicknameLenException
     * @throws PasswordFormatException|PasswordLenException
     */
    public function login(string $nickname, string $password): ?AuthEntity
    {
        $entity = null;
        $token = $this->jwt->attempt(['nickname' => $nickname, 'password' => $password]);

        if ($token) {
            /** @var User $user */
            $user = Auth::user();
            $entity = $this->getEntityFromUser($user);

            foreach ($user->permissions ?? [] as $key => $description) {
                $entity->permissions->assign(new Permission($key, $description));
            }
        }

        return $entity;
    }

    public function signIn(AuthEntity $entity): ?string
    {
        $token = $this->jwt->attempt([
            'nickname' => $entity->nickname->value,
            'password' => $entity->password->value
        ]);

        return $token?->get();
    }

    public function getToken(): ?string
    {
        return $this->jwt->getToken()?->get()
            ?? $this->jwt->fromUser(Auth::user());
    }

    public function refreshToken(): ?string
    {
        return $this->jwt?->refresh();
    }

    /**
     * @throws NicknameFormatException|NicknameLenException
     * @throws PasswordFormatException|PasswordLenException
     */
    public function get(string $token): ?AuthEntity
    {
        $this->jwt->setToken($token);

        /** @var User|null $user */
        $user = $this->jwt->authenticate();
        $entity = null;

        if ($user) {
            $entity = $this->getEntityFromUser($user);
        }

        return $entity;
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
        Auth::logout();
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

    /**
     * @throws NicknameFormatException|NicknameLenException
     * @throws PasswordFormatException|PasswordLenException
     */
    private function getEntityFromUser(User $user): AuthEntity
    {
        return new AuthEntity(
            $user->uuid,
            new Nickname($user->nickname),
            new Password($user->password),
        );
    }
}

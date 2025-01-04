<?php

declare(strict_types=1);

namespace Architecture\Domains\Auth\Factories;

use Architecture\Domains\Auth\Entities\AuthEntity;
use Architecture\Domains\Auth\Exceptions\NicknameFormatException;
use Architecture\Domains\Auth\Exceptions\NicknameLenException;
use Architecture\Domains\Auth\Exceptions\PasswordFormatException;
use Architecture\Domains\Auth\Exceptions\PasswordLenException;
use Architecture\Domains\Auth\ValueObjects\Nickname;
use Architecture\Domains\Auth\ValueObjects\Password;
use Architecture\Domains\Auth\ValueObjects\Permission;

class AuthEntityFactoryStrict implements AuthEntityFactoryInterface
{
    /**
     * @throws NicknameFormatException|NicknameLenException
     * @throws PasswordFormatException|PasswordLenException
     */
    public function make(array $payload): AuthEntity
    {
        $entity = new AuthEntity(
            $payload['uuid'],
            new Nickname($payload['nickname']),
            new Password($payload['password']),
        );

        foreach ($payload['permissions'] ?? [] as $key => $description) {
            $entity->permissions->assign(new Permission($key, $description));
        }

        return $entity;
    }
}

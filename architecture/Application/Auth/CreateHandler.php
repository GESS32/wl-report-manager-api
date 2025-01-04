<?php

declare(strict_types=1);

namespace Architecture\Application\Auth;

use Architecture\Domains\Auth\Entities\AuthEntity;
use Architecture\Domains\Auth\Exceptions\NicknameFormatException;
use Architecture\Domains\Auth\Exceptions\NicknameLenException;
use Architecture\Domains\Auth\Exceptions\PasswordFormatException;
use Architecture\Domains\Auth\Exceptions\PasswordLenException;
use Architecture\Domains\Auth\Repositories\AuthRepositoryInterface;
use Architecture\Domains\Auth\ValueObjects\Nickname;
use Architecture\Domains\Auth\ValueObjects\Password;

readonly class CreateHandler
{
    public function __construct(private AuthRepositoryInterface $authRepository) {}

    /**
     * @throws NicknameFormatException|NicknameLenException
     * @throws PasswordFormatException|PasswordLenException
     */
    public function execute(CreateCommand $request): AuthEntity
    {
        $nickname = new Nickname($request->nickname);
        $password = new Password($request->password);
        $auth = new AuthEntity($request->id, $nickname, $password);

        $this->authRepository->save($auth);

        return $auth;
    }
}

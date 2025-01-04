<?php

declare(strict_types=1);

namespace Architecture\Application\Auth;

use Architecture\Application\Auth\Dto\AuthenticatedDto;
use Architecture\Application\Auth\Dto\TokenDto;
use Architecture\Application\Auth\Exceptions\InvalidCredentialsException;
use Architecture\Domains\Auth\Repositories\AuthRepositoryInterface;

readonly class LoginHandler
{
    public function __construct(private AuthRepositoryInterface $repository) {}

    /**
     * @throws InvalidCredentialsException
     */
    public function execute(LoginCommand $request): AuthenticatedDto
    {
        $auth = $this->repository->login($request->nickname, $request->password);

        if ($auth === null) {
            throw new InvalidCredentialsException();
        }

        $token = new TokenDto($this->repository->getToken());

        return new AuthenticatedDto($auth, $token);
    }
}

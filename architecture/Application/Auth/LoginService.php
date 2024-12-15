<?php

declare(strict_types=1);

namespace Architecture\Application\Auth;

use Architecture\Application\Auth\Dto\AuthenticatedDto;
use Architecture\Application\Auth\Exceptions\InvalidCredentialsException;
use Architecture\Domains\Auth\Repositories\AuthRepositoryInterface;

readonly class LoginService
{
    public function __construct(private AuthRepositoryInterface $repository) {}

    /**
     * @throws InvalidCredentialsException
     */
    public function execute(string $nickname, string $password): AuthenticatedDto
    {
        $auth = $this->repository->login($nickname, $password);

        if ($auth === null) {
            throw new InvalidCredentialsException();
        }

        return new AuthenticatedDto($auth, $this->repository->getToken());
    }
}

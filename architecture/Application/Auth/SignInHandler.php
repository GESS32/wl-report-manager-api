<?php

declare(strict_types=1);

namespace Architecture\Application\Auth;

use Architecture\Application\Auth\Dto\TokenDto;
use Architecture\Application\Auth\Exceptions\InvalidCredentialsException;
use Architecture\Domains\Auth\Repositories\AuthRepositoryInterface;

readonly class SignInHandler
{
    public function __construct(private AuthRepositoryInterface $repository) {}

    /**
     * @throws InvalidCredentialsException
     */
    public function execute(SignInCommand $request): TokenDto
    {
        $token = $this->repository->signIn($request->entity);

        if ($token === null) {
            throw new InvalidCredentialsException();
        }

        return new TokenDto($this->repository->getToken());
    }
}

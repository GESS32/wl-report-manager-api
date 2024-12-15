<?php

declare(strict_types=1);

namespace Architecture\Application\Auth;

use Architecture\Application\Auth\Exceptions\TokenExpiredException;
use Architecture\Domains\Auth\Repositories\AuthRepositoryInterface;

readonly class RefreshTokenService
{
    public function __construct(private AuthRepositoryInterface $repository) {}

    /**
     * @throws TokenExpiredException
     */
    public function execute(): string
    {
        $token = $this->repository->refreshToken();

        if ($token === null) {
            throw new TokenExpiredException('Token expired, please login again');
        }

        return $token;
    }
}

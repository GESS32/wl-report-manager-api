<?php

declare(strict_types=1);

namespace Architecture\Application\Auth;

use Architecture\Domains\Auth\Repositories\AuthRepositoryInterface;

readonly class LogoutHandler
{
    public function __construct(private AuthRepositoryInterface $repository) {}

    public function execute(): void
    {
        $this->repository->logout();
    }
}

<?php

declare(strict_types=1);

namespace Architecture\Application\Auth;

readonly class LoginCommand
{
    public function __construct(
        public string $nickname,
        public string $password,
    ) {}
}

<?php

declare(strict_types=1);

namespace Architecture\Application\Auth;

readonly class RefreshTokenCommand
{
    public function __construct(public string $token) {}
}

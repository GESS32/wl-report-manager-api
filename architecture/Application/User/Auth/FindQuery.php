<?php

declare(strict_types=1);

namespace Architecture\Application\User\Auth;

readonly class FindQuery
{
    public function __construct(
        public string $token
    ) {}
}

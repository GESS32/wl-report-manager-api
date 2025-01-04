<?php

declare(strict_types=1);

namespace Architecture\Application\Auth;

readonly class CreateCommand
{
    public function __construct(
        public string|int $id,
        public string $nickname,
        public string $password
    ) {}
}

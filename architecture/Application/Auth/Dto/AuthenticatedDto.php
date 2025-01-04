<?php

declare(strict_types=1);

namespace Architecture\Application\Auth\Dto;

use Architecture\Domains\Auth\Entities\AuthEntity;

readonly class AuthenticatedDto
{
    public function __construct(
        public AuthEntity $entity,
        public TokenDto $token,
    ) {}
}

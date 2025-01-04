<?php

declare(strict_types=1);

namespace Architecture\Application\Auth;

use Architecture\Domains\Auth\Entities\AuthEntity;

readonly class SignInCommand
{
    public function __construct(public AuthEntity $entity) {}
}

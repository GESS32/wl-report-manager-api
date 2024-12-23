<?php

declare(strict_types=1);

namespace Architecture\Domains\Auth\Entities;

use Architecture\Domains\Auth\Collections\Permissions;
use Architecture\Domains\Auth\ValueObjects\Nickname;
use Architecture\Domains\Auth\ValueObjects\Password;

class AuthEntity
{
    public function __construct(
        public readonly string|int $id,
        public Nickname $nickname,
        public Password $password,
        public Permissions $permissions = new Permissions(),
    ) {}
}

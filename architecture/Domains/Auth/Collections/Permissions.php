<?php

declare(strict_types=1);

namespace Architecture\Domains\Auth\Collections;

use Architecture\Domains\Auth\ValueObjects\Permission;

class Permissions
{
    private array $permissions = [];

    public function __construct() {}

    public function assign(Permission $permission): void
    {
        $this->permissions[$permission->key] = $permission->description;
    }

    public function remove(Permission $permission): void
    {
        unset($this->permissions[$permission->key]);
    }

    public function has(Permission $permission): bool
    {
        return isset($this->permissions[$permission->key]);
    }

    public function all(): array
    {
        return $this->permissions;
    }
}

<?php

declare(strict_types=1);

namespace Architecture\Domains\Auth\ValueObjects;

readonly class Permission
{
    public function __construct(public int $key, public string $description) {}

    public function equals(Permission $other): bool
    {
        return $this->key === $other->key;
    }
}

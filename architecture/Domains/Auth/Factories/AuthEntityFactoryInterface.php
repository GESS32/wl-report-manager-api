<?php

declare(strict_types=1);

namespace Architecture\Domains\Auth\Factories;

use Architecture\Domains\Auth\Entities\AuthEntity;

interface AuthEntityFactoryInterface
{
    public function make(array $payload): AuthEntity;
}

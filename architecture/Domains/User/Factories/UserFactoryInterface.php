<?php

declare(strict_types=1);

namespace Architecture\Domains\User\Factories;

use Architecture\Domains\User\Entities\UserEntity;

interface UserFactoryInterface
{
    public function make(array $request): UserEntity;
}

<?php

declare(strict_types=1);

namespace Architecture\Domains\User\Factories;

use Architecture\Domains\User\ValueObjects\Identifier;

interface UserIdentifierFactoryInterface
{
    public function make(): Identifier;
}

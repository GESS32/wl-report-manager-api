<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\User;

use Architecture\Domains\User\ValueObjects\Identifier;
use Architecture\Domains\User\Factories\UserIdentifierFactoryInterface;
use Ramsey\Uuid\Guid\Guid;

class UserIdentifierFactoryUuid4 implements UserIdentifierFactoryInterface
{
    public function make(): Identifier
    {
        return new Identifier(Guid::uuid4()->toString());
    }
}

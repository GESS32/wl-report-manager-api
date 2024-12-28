<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Adapters;

use InvalidArgumentException;
use Ramsey\Uuid\Guid\Guid;

class UuidRamseyAdapter implements UuidAdapterInterface
{
    /**
     * @throws InvalidArgumentException
     */
    public function generate(int $version = 4, array $properties = []): string
    {
        $uuid = match ($version) {
            1 => Guid::uuid1(),
            2 => Guid::uuid2(...$properties),
            3 => Guid::uuid3(...$properties),
            4 => Guid::uuid4(),
            5 => Guid::uuid5(...$properties),
            6 => Guid::uuid6(),
            7 => Guid::uuid7(),
            8 => Guid::uuid8(...$properties),
            default => throw new InvalidArgumentException('Invalid UUID version'),
        };

        return $uuid->toString();
    }
}

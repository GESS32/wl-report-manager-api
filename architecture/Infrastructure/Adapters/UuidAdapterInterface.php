<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Adapters;

use InvalidArgumentException;

interface UuidAdapterInterface
{
    /**
     * @throws InvalidArgumentException
     */
    public function generate(int $version, array $properties = []): string;
}

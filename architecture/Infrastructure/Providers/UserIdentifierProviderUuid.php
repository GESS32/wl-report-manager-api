<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Providers;

use Architecture\Domains\User\Providers\IdentifierProviderInterface;
use Architecture\Infrastructure\Adapters\UuidAdapterInterface;

readonly class UserIdentifierProviderUuid implements IdentifierProviderInterface
{
    public function __construct(private UuidAdapterInterface $uuid) {}

    public function generate(): string|int
    {
        return $this->uuid->generate(4);
    }
}

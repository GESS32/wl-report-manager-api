<?php

declare(strict_types=1);

namespace Architecture\Domains\User\Providers;

interface IdentifierProviderInterface
{
    public function generate(): string|int;
}

<?php

declare(strict_types=1);

namespace Architecture\Domains\User\Factories;

use Architecture\Domains\User\Providers\IdentifierProviderInterface;
use Architecture\Domains\User\ValueObjects\Identifier;
use Throwable;

readonly class IdentifierFactoryFromProvider implements IdentifierFactoryInterface
{
    public function __construct(private IdentifierProviderInterface $provider) {}

    /**
     * @throws Throwable
     */
    public function make(): Identifier
    {
        return new Identifier($this->provider->generate());
    }
}

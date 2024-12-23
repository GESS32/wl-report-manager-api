<?php

declare(strict_types=1);

namespace Architecture\Domains\User\Localizations;

class LocalizeRequest
{
    private array $items;

    public function __construct(public readonly string $contextKey) {}

    public function add(string $key, string|int|float|null $value): void
    {
        $this->items[$key] = $value;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}

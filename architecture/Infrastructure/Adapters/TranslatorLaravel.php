<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Adapters;

class TranslatorLaravel implements TranslatorAdapterInterface
{
    public function resolve(string $key, array $replace = [], ?string $locale = null): string|array
    {
        return trans($key, $replace, $locale);
    }
}

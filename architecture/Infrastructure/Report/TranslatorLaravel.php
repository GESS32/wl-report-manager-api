<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Report;

use Architecture\Domains\Prompt\Translators\TranslatorInterface;

class TranslatorLaravel implements TranslatorInterface
{
    public function translate(string $key, array $replace = [], ?string $locale = null): string
    {
        return trans($key, $replace, $locale);
    }
}

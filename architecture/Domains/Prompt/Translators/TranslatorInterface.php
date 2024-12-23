<?php

declare(strict_types=1);

namespace Architecture\Domains\Prompt\Translators;

interface TranslatorInterface
{
    public function translate(string $key, array $replace = [], ?string $locale = null): string;
}

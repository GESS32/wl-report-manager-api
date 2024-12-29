<?php

declare(strict_types=1);

namespace Architecture\Domains\Prompt\Services;

interface TranslatorServiceInterface
{
    public function translate(string $key, array $replace = [], ?string $locale = null): string;
}

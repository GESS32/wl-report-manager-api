<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Services;

use Architecture\Domains\Prompt\Services\TranslatorServiceInterface;
use Architecture\Infrastructure\Adapters\TranslatorAdapterInterface;

readonly class PromptTranslatorService implements TranslatorServiceInterface
{
    public function __construct(private TranslatorAdapterInterface $translator) {}

    public function translate(string $key, array $replace = [], ?string $locale = null): string
    {
        return $this->translator->resolve($key, $replace, $locale);
    }
}

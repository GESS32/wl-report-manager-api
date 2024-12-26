<?php

declare(strict_types=1);

namespace Architecture\Domains\User\Localizations;

interface LocalizationInterface
{
    public function translate(TranslatableInterface $translatable, ?string $locale = null): string;
}

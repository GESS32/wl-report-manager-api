<?php

declare(strict_types=1);

namespace Architecture\Domains\User\Services;

use Architecture\Domains\User\Contracts\TranslatableInterface;

interface LocalizationServiceInterface
{
    public function translate(TranslatableInterface $translatable, ?string $locale = null): string;
}

<?php

declare(strict_types=1);

namespace Architecture\Domains\User\Localizations;

interface TranslatableInterface
{
    public function getLocalizeRequest(): LocalizeRequest;
}

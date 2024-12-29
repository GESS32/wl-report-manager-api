<?php

declare(strict_types=1);

namespace Architecture\Domains\User\Contracts;

use Architecture\Domains\User\Entities\LocalizeGroupEntity;

interface TranslatableInterface
{
    public function getLocalizeGroup(): LocalizeGroupEntity;
}

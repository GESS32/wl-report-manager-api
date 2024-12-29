<?php

declare(strict_types=1);

namespace Architecture\Domains\User\Factories;

use Architecture\Domains\User\Entities\LocalizeGroupEntity;

class LocalizeGroupEntityFactory
{
    public static function make(): LocalizeGroupEntity
    {
        return new LocalizeGroupEntity(uniqid('user_localize_group_', true));
    }
}

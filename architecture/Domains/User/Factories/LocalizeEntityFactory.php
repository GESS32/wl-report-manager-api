<?php

declare(strict_types=1);

namespace Architecture\Domains\User\Factories;

use Architecture\Domains\User\Entities\LocalizeEntity;

class LocalizeEntityFactory
{
    public static function make(): LocalizeEntity
    {
        return new LocalizeEntity(uniqid('user_localize_entity_', true));
    }
}

<?php

declare(strict_types=1);

namespace Architecture\Domains\User\Enums;

enum SpecializationEnum: int
{
    case NONE = 0;
    case PHP = 1;
    case JS = 2;

    public function isset(): bool
    {
        return $this !== self::NONE;
    }
}

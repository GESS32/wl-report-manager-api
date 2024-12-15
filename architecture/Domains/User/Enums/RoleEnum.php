<?php

declare(strict_types=1);

namespace Architecture\Domains\User\Enums;

enum RoleEnum: int
{
    case DEVELOPER = 1;
    case QA = 2;
    case MANAGER = 3;
    case DESIGNER = 4;
}

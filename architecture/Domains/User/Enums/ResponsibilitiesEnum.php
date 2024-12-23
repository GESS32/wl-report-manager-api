<?php

declare(strict_types=1);

namespace Architecture\Domains\User\Enums;

enum ResponsibilitiesEnum: int
{
    case FRONTEND = 1;
    case BACKEND = 2;
    case FULLSTACK = 3;
    case QA = 4;
    case MANAGER = 5;
    case SUPPORT = 6;
    case TECH_LEAD = 7;
}

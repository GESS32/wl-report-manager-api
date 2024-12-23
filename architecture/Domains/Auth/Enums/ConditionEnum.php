<?php

declare(strict_types=1);

namespace Architecture\Domains\Auth\Enums;

enum ConditionEnum: int
{
    case GREATER_THAN = 1;
    case LESS_THAN = 2;
    case EQUAL = 3;
    case GREATER_THAN_OR_EQUAL = 4;
    case LESS_THAN_OR_EQUAL = 5;
}

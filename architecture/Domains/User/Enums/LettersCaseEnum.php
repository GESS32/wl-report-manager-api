<?php

declare(strict_types=1);

namespace Architecture\Domains\User\Enums;

enum LettersCaseEnum: int
{
    case DEFAULT = 0;
    case LOWER = 1;
    case UPPER = 2;
    case UPPER_FIRST = 3;
    case LOWER_FIRST = 4;
    case UPPER_WORDS = 5;
}

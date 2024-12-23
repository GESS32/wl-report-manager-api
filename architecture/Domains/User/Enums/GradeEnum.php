<?php

declare(strict_types=1);

namespace Architecture\Domains\User\Enums;

enum GradeEnum: int
{
    case TRAINEE = 1;
    case TRAINEE_PLUS = 2;
    CASE JUNIOR = 3;
    CASE JUNIOR_PLUS = 4;
    CASE MIDDLE = 5;
    CASE MIDDLE_PLUS = 6;
    CASE SENIOR = 7;
    CASE SENIOR_PLUS = 8;
    CASE LEAD = 9;
}

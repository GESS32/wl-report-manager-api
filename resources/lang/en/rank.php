<?php

use Architecture\Domains\User\Enums\GradeEnum;

return [
    'grade' => [
        GradeEnum::TRAINEE->value => 'trainee',
        GradeEnum::TRAINEE_PLUS->value => 'trainee +',
        GradeEnum::JUNIOR->value => 'junior',
        GradeEnum::JUNIOR_PLUS->value => 'junior +',
        GradeEnum::MIDDLE->value => 'middle',
        GradeEnum::MIDDLE_PLUS->value => 'middle +',
        GradeEnum::SENIOR->value => 'senior',
        GradeEnum::SENIOR_PLUS->value => 'senior +',
        GradeEnum::LEAD->value => 'team lead',
    ],

    'experience' => 'with :experience year(s) experience',
];

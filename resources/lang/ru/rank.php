<?php

use Architecture\Domains\User\Enums\GradeEnum;

return [
    'grade' => [
        GradeEnum::TRAINEE->value => 'Trainee',
        GradeEnum::TRAINEE_PLUS->value => 'Trainee +',
        GradeEnum::JUNIOR->value => 'Junior',
        GradeEnum::JUNIOR_PLUS->value => 'Junior +',
        GradeEnum::MIDDLE->value => 'Middle',
        GradeEnum::MIDDLE_PLUS->value => 'Middle +',
        GradeEnum::SENIOR->value => 'Senior',
        GradeEnum::SENIOR_PLUS->value => 'Senior +',
        GradeEnum::LEAD->value => 'Team lead',
    ],

    'grade_label' => 'уровень',
    'experience' => 'с :value летним опытом',
];

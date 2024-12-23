<?php

use Architecture\Domains\User\Enums\ResponsibilitiesEnum;
use Architecture\Domains\User\Enums\RoleEnum;

return [
    'role' => [
        RoleEnum::DEVELOPER->value => 'developer',
        RoleEnum::QA->value => 'QA engineer',
        RoleEnum::MANAGER->value => 'project manager',
        RoleEnum::DESIGNER->value => 'UI/UX designer',
    ],
    'responsibilities' => [
        ResponsibilitiesEnum::FRONTEND->value => 'frontend app developing',
        ResponsibilitiesEnum::BACKEND->value => 'backend app developing',
        ResponsibilitiesEnum::FULLSTACK->value => 'fullstack developing',
        ResponsibilitiesEnum::QA->value => 'test develop results',
        ResponsibilitiesEnum::MANAGER->value => 'manage projects',
        ResponsibilitiesEnum::SUPPORT->value => 'support applications',
        ResponsibilitiesEnum::TECH_LEAD->value => 'tech lead of project',
    ],
];

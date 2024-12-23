<?php

use Architecture\Domains\User\Enums\ResponsibilitiesEnum;
use Architecture\Domains\User\Enums\RoleEnum;

return [
    'role' => [
        RoleEnum::DEVELOPER->value => 'разработчик',
        RoleEnum::QA->value => 'QA инженер',
        RoleEnum::MANAGER->value => 'проектный менеджер',
        RoleEnum::DESIGNER->value => 'UI/UX дизайнер',
    ],
    'responsibilities' => [
        ResponsibilitiesEnum::FRONTEND->value => 'разработка фронтенд приложений',
        ResponsibilitiesEnum::BACKEND->value => 'разработка бэкенд приложений',
        ResponsibilitiesEnum::FULLSTACK->value => 'фуллстек разработка',
        ResponsibilitiesEnum::QA->value => 'проверка результатов разработки',
        ResponsibilitiesEnum::MANAGER->value => 'заниматься менеджментом проекта',
        ResponsibilitiesEnum::SUPPORT->value => 'поддержка приложений',
        ResponsibilitiesEnum::TECH_LEAD->value => 'технический лидер проекта',
    ],
];

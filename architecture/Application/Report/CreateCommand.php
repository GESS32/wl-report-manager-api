<?php

declare(strict_types=1);

namespace Architecture\Application\Report;

use Architecture\Domains\User\Entities\UserEntity;

readonly class CreateCommand
{
    public function __construct(
        public UserEntity $user,
        public string $task,
        public string $description,
        public string $spendTime,
        public string $lang,
        public string $template,
    ) {}
}

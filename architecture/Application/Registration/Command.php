<?php

declare(strict_types=1);

namespace Architecture\Application\Registration;

use Architecture\Domains\User\Enums\GradeEnum;
use Architecture\Domains\User\Enums\RoleEnum;
use Architecture\Domains\User\Enums\SpecializationEnum;

class Command
{
    public function __construct(
        public GradeEnum $grade,
        public RoleEnum $role,
        public SpecializationEnum $specialization,
        public float $experience,
        public string $nickname,
        public string $password,
        public array $responsibilities = []
    ) {}
}

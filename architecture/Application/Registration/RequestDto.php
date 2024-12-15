<?php

declare(strict_types=1);

namespace Architecture\Application\Registration;

use Architecture\Domains\User\Enums\GradeEnum;
use Architecture\Domains\User\Enums\RoleEnum;

readonly class RequestDto
{
    public function __construct(
        public GradeEnum $grade,
        public RoleEnum $role,
        public float $experience,
        public string $nickname,
        public string $password,
        public array $responsibilities = []
    ) {}
}

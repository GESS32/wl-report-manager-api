<?php

declare(strict_types=1);

namespace Architecture\Application\User\Create;

use Architecture\Domains\User\Enums\GradeEnum;
use Architecture\Domains\User\Enums\RoleEnum;
use Architecture\Domains\User\Enums\SpecializationEnum;

readonly class Command
{
    public function __construct(
        public GradeEnum $grade,
        public RoleEnum $role,
        public SpecializationEnum $specialization,
        public float $experience,
        public array $responsibilities = []
    ) {}

    public function toArray(): array
    {
        return [
            'grade' => $this->grade,
            'role' => $this->role,
            'specialization' => $this->specialization,
            'experience' => $this->experience,
            'responsibilities' => $this->responsibilities,
        ];
    }
}

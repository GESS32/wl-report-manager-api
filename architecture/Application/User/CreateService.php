<?php

declare(strict_types=1);

namespace Architecture\Application\User;

use Architecture\Domains\User\Entities\UserEntity;
use Architecture\Domains\User\Enums\GradeEnum;
use Architecture\Domains\User\Enums\RoleEnum;
use Architecture\Domains\User\Enums\SpecializationEnum;
use Architecture\Domains\User\Factories\IdentifierFactoryInterface;
use Architecture\Domains\User\Factories\UserFactoryInterface;
use Architecture\Domains\User\Repositories\UserRepositoryInterface;
use Throwable;

readonly class CreateService
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private IdentifierFactoryInterface $identifierFactory,
        private UserFactoryInterface $userFactory
    ) {}

    /**
     * @throws Throwable
     */
    public function execute(
        GradeEnum $grade,
        RoleEnum $role,
        SpecializationEnum $specialization,
        float $experience,
        array $responsibilities = []
    ): UserEntity {
        $user = $this->userFactory->make([
            'uuid' => $this->identifierFactory->make(),
            'grade' => $grade,
            'experience' => $experience,
            'role' => $role,
            'specialization' => $specialization,
            'responsibilities' => $responsibilities,
        ]);

        $this->repository->store($user);

        return $user;
    }
}

<?php

declare(strict_types=1);

namespace Architecture\Application\User;

use Architecture\Domains\User\Entities\UserEntity;
use Architecture\Domains\User\Enums\GradeEnum;
use Architecture\Domains\User\Enums\RoleEnum;
use Architecture\Domains\User\Enums\SpecializationEnum;
use Architecture\Domains\User\Exceptions\ExperienceInputException;
use Architecture\Domains\User\Factories\UserIdentifierFactoryInterface;
use Architecture\Domains\User\Repositories\UserRepositoryInterface;
use Architecture\Domains\User\ValueObjects\Position;
use Architecture\Domains\User\ValueObjects\Rank;

readonly class CreateService
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private UserIdentifierFactoryInterface $factory
    ) {}

    /**
     * @throws ExperienceInputException
     */
    public function execute(
        GradeEnum $grade,
        RoleEnum $role,
        SpecializationEnum $specialization,
        float $experience,
        array $responsibilities = []
    ): UserEntity {
        $identifier = $this->factory->make();
        $rank = new Rank($grade, $experience);
        $position = new Position($role, $specialization, $responsibilities);
        $user = new UserEntity($identifier, $rank, $position);

        $this->repository->store($user);

        return $user;
    }
}

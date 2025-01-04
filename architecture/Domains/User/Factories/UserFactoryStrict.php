<?php

declare(strict_types=1);

namespace Architecture\Domains\User\Factories;

use Architecture\Domains\User\Entities\UserEntity;
use Architecture\Domains\User\Enums\GradeEnum;
use Architecture\Domains\User\Enums\RoleEnum;
use Architecture\Domains\User\Enums\SpecializationEnum;
use Architecture\Domains\User\Exceptions\ExperienceInputException;
use Architecture\Domains\User\Exceptions\IdentifierInputException;
use Architecture\Domains\User\ValueObjects\Identifier;
use Architecture\Domains\User\ValueObjects\Position;
use Architecture\Domains\User\ValueObjects\Rank;
use ValueError;

class UserFactoryStrict implements UserFactoryInterface
{
    /**
     * @throws ExperienceInputException|IdentifierInputException|ValueError
     */
    public function make(array $request): UserEntity
    {
        $id = new Identifier($request['uuid']);
        $grade = GradeEnum::from($request['grade']);
        $rank = new Rank($grade, $request['experience']);
        $role = RoleEnum::from($request['role']);
        $specialization = SpecializationEnum::from($request['specialization']);
        $position = new Position($role, $specialization, $request['responsibilities']);

        return new UserEntity($id, $rank, $position);
    }
}

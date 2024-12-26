<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\User;

use App\Models\User;
use Architecture\Domains\User\Entities\UserEntity;
use Architecture\Domains\User\Enums\GradeEnum;
use Architecture\Domains\User\Enums\RoleEnum;
use Architecture\Domains\User\Enums\SpecializationEnum;
use Architecture\Domains\User\Factories\UserFactoryInterface;
use Architecture\Domains\User\ValueObjects\Identifier;
use Architecture\Domains\User\ValueObjects\Position;
use Architecture\Domains\User\ValueObjects\Rank;
use Exception;

class UserFactoryEloquent implements UserFactoryInterface
{
    /**
     * @param User $request
     *
     * @throws Exception
     */
    public function make(mixed $request): UserEntity
    {
        return new UserEntity(
            new Identifier($request->uuid),
            new Rank(GradeEnum::from($request->grade), $request->experience),
            new Position(
                RoleEnum::from($request->role),
                SpecializationEnum::from($request->specialization),
                $request->responsibilities
            ),
        );
    }
}

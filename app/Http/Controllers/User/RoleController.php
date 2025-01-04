<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Resources\RoleResource;
use App\Http\Resources\RoleResourceCollection;
use Architecture\Domains\User\Enums\RoleEnum;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RoleController
{
    public function index(): RoleResourceCollection
    {
        return new RoleResourceCollection();
    }

    public function show(mixed $role): RoleResource
    {
        $role = RoleEnum::tryFrom((int) $role);

        if ($role === null) {
            throw new NotFoundHttpException('Role not found');
        }

        return new RoleResource($role);
    }
}

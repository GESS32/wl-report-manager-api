<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Architecture\Domains\User\Enums\RoleEnum;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RoleResourceCollection extends ResourceCollection
{
    public $collects = RoleResource::class;

    public function __construct()
    {
        parent::__construct(RoleEnum::cases());
    }
}

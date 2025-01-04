<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Architecture\Domains\User\Enums\RoleEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    public function __construct(RoleEnum $resource)
    {
        parent::__construct([
            'name' => trans("position.role.$resource->value"),
            'value' => $resource->value,
        ]);
    }
}

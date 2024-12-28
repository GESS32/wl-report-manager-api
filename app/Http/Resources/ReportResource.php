<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    /** @var string */
    public $resource;

    public function toArray(Request $request): array
    {
        $payload = explode('----', $this->resource);

        return [
            'report' => trim(array_shift($payload)),
            'estimation' => trim(array_pop($payload)),
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    public function __construct(string $resource)
    {
        $payload = explode('----', $resource);

        parent::__construct([
            'report' => trim(array_shift($payload)),
            'estimation' => trim(array_pop($payload)),
        ]);
    }
}

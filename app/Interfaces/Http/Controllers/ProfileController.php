<?php

declare(strict_types=1);

namespace App\Interfaces\Http\Controllers;

use Illuminate\Http\JsonResponse;

class ProfileController
{
    /**
     * @TODO:: remove this method
     */
    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }
}

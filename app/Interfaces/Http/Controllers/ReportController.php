<?php

declare(strict_types=1);

namespace App\Interfaces\Http\Controllers;

use App\Interfaces\Http\Requests\ReportRequest;
use Architecture\Application\Report\CreateService;
use Architecture\Domains\User\Entities\UserEntity;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class ReportController extends Controller
{
    public function __invoke(ReportRequest $request, UserEntity $user, CreateService $service): JsonResponse
    {
        $response = $service->execute($request->toDto($user));
        return new JsonResponse(['data' => $response]);
    }
}

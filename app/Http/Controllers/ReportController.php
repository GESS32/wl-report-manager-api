<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Http\Resources\ReportResource;
use Architecture\Application\Report\CreateHandler;
use Architecture\Domains\User\Entities\UserEntity;
use Illuminate\Routing\Controller;

class ReportController extends Controller
{
    public function store(ReportRequest $request, UserEntity $user, CreateHandler $service): ReportResource
    {
        $response = $service->execute($request->toDto($user));
        return new ReportResource($response);
    }
}

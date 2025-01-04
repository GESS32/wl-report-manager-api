<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ReportCreateRequest;
use App\Http\Resources\ReportResource;
use Architecture\Application\Report\CreateHandler;
use Architecture\Domains\User\Entities\UserEntity;
use Illuminate\Routing\Controller;

class ReportController extends Controller
{
    public function store(ReportCreateRequest $request, UserEntity $user, CreateHandler $handler): ReportResource
    {
        $response = $handler->execute($request->toCommand($user));
        return new ReportResource($response);
    }
}

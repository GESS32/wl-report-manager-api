<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Architecture\Application\Auth\Exceptions\InvalidCredentialsException;
use Architecture\Application\Auth\Exceptions\TokenExpiredException;
use Architecture\Application\Auth\LoginService;
use Architecture\Application\Auth\LogoutService;
use Architecture\Application\Auth\RefreshTokenService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(LoginRequest $request, LoginService $service): JsonResponse
    {
        $response = new JsonResponse();

        try {
            $auth = $service->execute(
                $request->getNicknameAttribute(),
                $request->getPasswordAttribute()
            );

            $response->setData(['token' => $auth->token]);
        } catch (InvalidCredentialsException $exception) {
            $response->setStatusCode(Response::HTTP_UNAUTHORIZED, $exception->getMessage());
        }

        return $response;
    }

    public function refresh(Request $request, RefreshTokenService $service): JsonResponse
    {
        $response = new JsonResponse();

        try {
            $token = $service->execute($request->bearerToken());
            $response->setData(['token' => $token]);
        } catch (TokenExpiredException $exception) {
            $response->setStatusCode(Response::HTTP_UNAUTHORIZED, $exception->getMessage());
        }

        return $response;
    }

    public function logout(LogoutService $service): JsonResponse
    {
        $service->execute();
        return new JsonResponse();
    }
}

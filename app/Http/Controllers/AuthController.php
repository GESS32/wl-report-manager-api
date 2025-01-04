<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Architecture\Application\Auth\Exceptions\InvalidCredentialsException;
use Architecture\Application\Auth\Exceptions\TokenExpiredException;
use Architecture\Application\Auth\LoginHandler;
use Architecture\Application\Auth\LogoutHandler;
use Architecture\Application\Auth\RefreshTokenCommand;
use Architecture\Application\Auth\RefreshTokenHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(LoginRequest $request, LoginHandler $handler): JsonResponse
    {
        $response = new JsonResponse();

        try {
            $auth = $handler->execute($request->toCommand());
            $response->setData(['token' => $auth->token->value]);
        } catch (InvalidCredentialsException $exception) {
            $response->setStatusCode(Response::HTTP_UNAUTHORIZED, $exception->getMessage());
        }

        return $response;
    }

    public function refresh(Request $request, RefreshTokenHandler $handler): JsonResponse
    {
        $response = new JsonResponse();
        $command = new RefreshTokenCommand($request->bearerToken());

        try {
            $token = $handler->execute($command);
            $response->setData(['token' => $token]);
        } catch (TokenExpiredException $exception) {
            $response->setStatusCode(Response::HTTP_UNAUTHORIZED, $exception->getMessage());
        }

        return $response;
    }

    public function logout(LogoutHandler $handler): JsonResponse
    {
        $handler->execute();
        return new JsonResponse();
    }
}

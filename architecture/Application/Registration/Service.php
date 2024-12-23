<?php

declare(strict_types=1);

namespace Architecture\Application\Registration;

use Architecture\Application\Auth\Exceptions\InvalidCredentialsException;
use Architecture\Application\Auth\SaveService;
use Architecture\Application\Auth\SignInService;
use Architecture\Application\User\CreateService;
use Architecture\Domains\Auth\Exceptions\NicknameFormatException;
use Architecture\Domains\Auth\Exceptions\NicknameLenException;
use Architecture\Domains\Auth\Exceptions\PasswordFormatException;
use Architecture\Domains\Auth\Exceptions\PasswordLenException;
use Architecture\Domains\User\Exceptions\ExperienceInputException;

readonly class Service
{
    public function __construct(
        private CreateService $userCreateService,
        private SaveService $authSaveService,
        private SignInService $signInService
    ) {}

    /**
     * @throws NicknameFormatException|NicknameLenException
     * @throws PasswordFormatException|ExperienceInputException|PasswordLenException
     * @throws InvalidCredentialsException
     */
    public function execute(RequestDto $request): ResponseDto
    {
        $user = $this->userCreateService->execute(
            $request->grade,
            $request->role,
            $request->experience,
            $request->responsibilities
        );

        $auth = $this->authSaveService->execute(
            $user,
            $request->nickname,
            $request->password
        );

        $token = $this->signInService->execute($auth)->token;

        return new ResponseDto($user, $auth, $token);
    }
}

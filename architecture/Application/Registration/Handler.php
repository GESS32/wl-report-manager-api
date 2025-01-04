<?php

declare(strict_types=1);

namespace Architecture\Application\Registration;

use Architecture\Application\Auth\SaveService;
use Architecture\Application\Auth\SignInService;
use Architecture\Application\User\CreateService;
use Throwable;

readonly class Handler
{
    public function __construct(
        private CreateService $userCreateService,
        private SaveService $authSaveService,
        private SignInService $signInService
    ) {}

    /**
     * @throws Throwable
     */
    public function execute(Command $request): ResponseDto
    {
        $user = $this->userCreateService->execute(
            $request->grade,
            $request->role,
            $request->specialization,
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

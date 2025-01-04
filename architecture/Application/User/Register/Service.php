<?php

declare(strict_types=1);

namespace Architecture\Application\User\Register;

use Architecture\Application\Auth\CreateCommand as AuthCreateCommand;
use Architecture\Application\Auth\CreateHandler as AuthCreateHandler;
use Architecture\Application\Auth\SignInCommand;
use Architecture\Application\Auth\SignInHandler;
use Architecture\Application\User\Create\Command as UserCreateCommand;
use Architecture\Application\User\Create\Handler as UserCreateHandler;
use Throwable;

readonly class Service
{
    public function __construct(
        private UserCreateHandler $userCreateHandler,
        private AuthCreateHandler $authCreateHandler,
        private SignInHandler $signInHandler
    ) {}

    /**
     * @throws Throwable
     */
    public function execute(RequestDto $request): ResponseDto
    {
        $user = $this->userCreateHandler->execute(new UserCreateCommand(
            $request->grade,
            $request->role,
            $request->specialization,
            $request->experience,
            $request->responsibilities
        ));

        $auth = $this->authCreateHandler->execute(new AuthCreateCommand(
            $user->id->value,
            $request->nickname,
            $request->password
        ));

        $token = $this->signInHandler->execute(new SignInCommand($auth));

        return new ResponseDto($user, $auth, $token);
    }
}

<?php

declare(strict_types=1);

namespace Architecture\Application\User\Register;

use Architecture\Application\Auth\Dto\TokenDto;
use Architecture\Domains\Auth\Entities\AuthEntity;
use Architecture\Domains\User\Entities\UserEntity;

readonly class ResponseDto
{
    public function __construct(
        public UserEntity $user,
        public AuthEntity $auth,
        public TokenDto $token
    ) {}
}

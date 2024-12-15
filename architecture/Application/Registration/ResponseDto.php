<?php

declare(strict_types=1);

namespace Architecture\Application\Registration;

use Architecture\Domains\Auth\Entities\AuthEntity;
use Architecture\Domains\User\Entities\UserEntity;

readonly class ResponseDto
{
    public function __construct(
        public UserEntity $user,
        public AuthEntity $auth,
        public string $token
    ) {}
}

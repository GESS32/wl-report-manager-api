<?php

declare(strict_types=1);

namespace Architecture\Application\Auth\Dto;

final readonly class TokenDto
{
    public function __construct(public string $value) {}
}

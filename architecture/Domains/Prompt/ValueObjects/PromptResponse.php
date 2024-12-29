<?php

declare(strict_types=1);

namespace Architecture\Domains\Prompt\ValueObjects;

readonly class PromptResponse
{
    public function __construct(public string $body, public int $statusCode) {}

    public function isSuccess(): bool
    {
        return $this->statusCode >= 200 && $this->statusCode < 300;
    }

    public function isFailure(): bool
    {
        return $this->isSuccess() === false;
    }
}

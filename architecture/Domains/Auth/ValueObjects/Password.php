<?php

declare(strict_types=1);

namespace Architecture\Domains\Auth\ValueObjects;

use Architecture\Domains\Auth\Enums\ConditionEnum;
use Architecture\Domains\Auth\Exceptions\PasswordFormatException;
use Architecture\Domains\Auth\Exceptions\PasswordLenException;

readonly class Password
{
    public string $value;

    /**
     * @throws PasswordLenException|PasswordFormatException
     */
    public function __construct(string $value)
    {
        $exception = null;

        if (strlen($value) < 8) {
            $exception = new PasswordLenException('Must be at least 8 characters long');
            $exception->condition = ConditionEnum::GREATER_THAN_OR_EQUAL;
            $exception->value = 8;
        }

        if (strlen($value) > 255) {
            $exception = new PasswordLenException('Must be less than 255 characters long');
            $exception->condition = ConditionEnum::LESS_THAN;
            $exception->value = 255;
        }

        if (preg_match('/^[a-zA-Z0-9!@#$%^&*()\-_=+\[\]{};:,.<>\/?~]+$/', $value) === 0) {
            $exception = new PasswordFormatException('Must contain only latin, numbers, and special characters');
        }

        if ($exception) {
            throw $exception;
        }

        $this->value = $value;
    }

    public function equal(Password $other): bool
    {
        return $this->value === $other->value;
    }
}

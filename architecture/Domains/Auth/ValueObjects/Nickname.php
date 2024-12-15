<?php

declare(strict_types=1);

namespace Architecture\Domains\Auth\ValueObjects;

use Architecture\Domains\Auth\Enums\ConditionEnum;
use Architecture\Domains\Auth\Exceptions\NicknameFormatException;
use Architecture\Domains\Auth\Exceptions\NicknameLenException;

readonly class Nickname
{
    public string $value;

    /**
     * @throws NicknameLenException|NicknameFormatException
     */
    public function __construct(string $value)
    {
        $value = trim($value);
        $valueLength = strlen($value);
        $exception = null;

        if ($valueLength < 3) {
            $exception = new NicknameLenException('Must be at least 3 characters long');
            $exception->condition = ConditionEnum::GREATER_THAN_OR_EQUAL;
            $exception->value = 3;
        }

        if ($valueLength > 32) {
            $exception = new NicknameLenException('Must be at most 32 characters long');
            $exception->condition = ConditionEnum::LESS_THAN_OR_EQUAL;
            $exception->value = 32;
        }

        if (preg_match('/^[a-zA-Z]+$/', $value) === 0) {
            $exception = new NicknameFormatException('Must contain only letters');
        }

        if ($exception) {
            throw $exception;
        }

        $this->value = $value;
    }
}

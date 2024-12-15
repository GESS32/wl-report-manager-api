<?php

declare(strict_types=1);

namespace Architecture\Domains\User\ValueObjects;

use Architecture\Domains\User\Exceptions\IdentifierInputException;
use Exception;

readonly class Identifier
{
    public string|int $value;

    /**
     * @throws Exception
     */
    public function __construct(string|int $value)
    {
        $exception = is_string($value)
            ? $this->doStringValidation($value)
            : $this->doIntValidation($value);

        if ($exception) {
            throw $exception;
        }

        $this->value = $value;
    }

    private function doStringValidation(string $value): ?Exception
    {
        $valueLen = strlen($value);

        return match (true) {
            $valueLen === 0 => new IdentifierInputException('Identifier cannot be empty'),
            $valueLen > 191 => new IdentifierInputException('Identifier cannot be longer than 191 characters'),
            default => null,
        };
    }

    private function doIntValidation(int $value): ?Exception
    {
        return match (true) {
            $value < 0 => new IdentifierInputException('Identifier cannot be negative'),
            $value === 0 => new IdentifierInputException('Identifier cannot be zero'),
            default => null,
        };
    }
}

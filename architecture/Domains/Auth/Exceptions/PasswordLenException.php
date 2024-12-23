<?php

declare(strict_types=1);

namespace Architecture\Domains\Auth\Exceptions;

use Architecture\Domains\Auth\Enums\ConditionEnum;
use Exception;

class PasswordLenException extends Exception
{
    public ConditionEnum $condition;
    public int $value;
}

<?php

declare(strict_types=1);

namespace Architecture\Domains\User\ValueObjects;

use Architecture\Domains\User\Enums\GradeEnum;
use Architecture\Domains\User\Exceptions\ExperienceInputException;
use Architecture\Domains\User\Localizations\LocalizeRequest;
use Architecture\Domains\User\Localizations\TranslatableInterface;

readonly class Rank implements TranslatableInterface
{
    public float $experience;

    /**
     * @throws ExperienceInputException
     */
    public function __construct(public GradeEnum $grade, float $experience)
    {
        if ($experience <= 0) {
            throw new ExperienceInputException('Experience must be greater then 0');
        }
    }

    public function getLocalizeRequest(): LocalizeRequest
    {
        $request = new LocalizeRequest('rank');

        $request->add('grade', $this->grade->value);
        $request->add('experience', $this->experience);

        return $request;
    }
}

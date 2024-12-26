<?php

declare(strict_types=1);

namespace Architecture\Domains\User\ValueObjects;

use Architecture\Domains\User\Enums\GradeEnum;
use Architecture\Domains\User\Enums\LettersCaseEnum;
use Architecture\Domains\User\Exceptions\ExperienceInputException;
use Architecture\Domains\User\Localizations\LocalizeGroupRequest;
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

        $this->experience = $experience;
    }

    public function getLocalizeRequest(): LocalizeGroupRequest
    {
        $request = new LocalizeGroupRequest();

        $request->add($this->getGradeRequest());
        $request->add($this->getExperienceRequest());

        return $request;
    }

    private function getGradeRequest(): LocalizeRequest
    {
        $request = new LocalizeRequest();
        $grade = $this->grade->value;

        $request->add('rank.grade_label', separator: ': ', case: LettersCaseEnum::UPPER_FIRST);
        $request->add("rank.grade.$grade");

        return $request;
    }

    private function getExperienceRequest(): LocalizeRequest
    {
        $request = new LocalizeRequest();

        $request->add('rank.experience', ['value' => $this->experience]);

        return $request;
    }
}

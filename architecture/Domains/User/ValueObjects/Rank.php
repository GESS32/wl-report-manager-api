<?php

declare(strict_types=1);

namespace Architecture\Domains\User\ValueObjects;

use Architecture\Domains\User\Enums\GradeEnum;
use Architecture\Domains\User\Enums\LettersCaseEnum;
use Architecture\Domains\User\Exceptions\ExperienceInputException;
use Architecture\Domains\User\Entities\LocalizeGroupEntity;
use Architecture\Domains\User\Entities\LocalizeEntity;
use Architecture\Domains\User\Contracts\TranslatableInterface;
use Architecture\Domains\User\Factories\LocalizeEntityFactory;
use Architecture\Domains\User\Factories\LocalizeGroupEntityFactory;

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

    public function getLocalizeGroup(): LocalizeGroupEntity
    {
        $request = LocalizeGroupEntityFactory::make();

        $request->add($this->getGradeRequest());
        $request->add($this->getExperienceRequest());

        return $request;
    }

    private function getGradeRequest(): LocalizeEntity
    {
        $request = LocalizeEntityFactory::make();
        $grade = $this->grade->value;

        $request->add('rank.grade_label', separator: ': ', case: LettersCaseEnum::UPPER_FIRST);
        $request->add("rank.grade.$grade");

        return $request;
    }

    private function getExperienceRequest(): LocalizeEntity
    {
        $request = LocalizeEntityFactory::make();

        $request->add('rank.experience', ['value' => $this->experience]);

        return $request;
    }
}

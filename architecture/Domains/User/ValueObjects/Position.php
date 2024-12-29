<?php

declare(strict_types=1);

namespace Architecture\Domains\User\ValueObjects;

use Architecture\Domains\User\Enums\LettersCaseEnum;
use Architecture\Domains\User\Enums\ResponsibilitiesEnum;
use Architecture\Domains\User\Enums\RoleEnum;
use Architecture\Domains\User\Enums\SpecializationEnum;
use Architecture\Domains\User\Entities\LocalizeGroupEntity;
use Architecture\Domains\User\Entities\LocalizeEntity;
use Architecture\Domains\User\Contracts\TranslatableInterface;
use Architecture\Domains\User\Factories\LocalizeEntityFactory;
use Architecture\Domains\User\Factories\LocalizeGroupEntityFactory;

readonly class Position implements TranslatableInterface
{
    /** @var array|ResponsibilitiesEnum[]|array<ResponsibilitiesEnum> */
    public array $responsibilities;

    public function __construct(
        public RoleEnum $role,
        public SpecializationEnum $specialization,
        array $responsibilities
    ) {
        $filter = static fn (mixed $responsibility): ResponsibilitiesEnum
            => $responsibility instanceof ResponsibilitiesEnum
                ? $responsibility
                : ResponsibilitiesEnum::from($responsibility);

        $this->responsibilities = array_map($filter, $responsibilities);
    }

    public function getLocalizeGroup(): LocalizeGroupEntity
    {
        $request = LocalizeGroupEntityFactory::make();
        $request->groupsSeparator = '. ';

        $request->add($this->getRoleRequest());
        $request->add($this->getResponsibilitiesRequest());

        return $request;
    }

    private function getRoleRequest(): LocalizeEntity
    {
        $request = LocalizeEntityFactory::make();
        $role = $this->role->value;
        $specialization = $this->specialization->value;

        $request->add('position.role_label', separator: ': ');

        if ($this->specialization->isset()) {
            $request->add("position.specialization.$specialization");
        }

        $request->add("position.role.$role");

        return $request;
    }

    private function getResponsibilitiesRequest(): LocalizeEntity
    {
        $request = LocalizeEntityFactory::make();

        $request->add('position.responsibilities_label', separator: ': ', case: LettersCaseEnum::UPPER_FIRST);

        foreach ($this->responsibilities as $responsibility) {
            $request->add("position.responsibilities.$responsibility->value", separator: ', ');
        }

        return $request;
    }
}

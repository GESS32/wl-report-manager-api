<?php

declare(strict_types=1);

namespace Architecture\Domains\User\ValueObjects;

use Architecture\Domains\User\Enums\LettersCaseEnum;
use Architecture\Domains\User\Enums\ResponsibilitiesEnum;
use Architecture\Domains\User\Enums\RoleEnum;
use Architecture\Domains\User\Enums\SpecializationEnum;
use Architecture\Domains\User\Localizations\LocalizeGroupRequest;
use Architecture\Domains\User\Localizations\LocalizeRequest;
use Architecture\Domains\User\Localizations\TranslatableInterface;

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

    public function getLocalizeRequest(): LocalizeGroupRequest
    {
        $request = new LocalizeGroupRequest();
        $request->groupsSeparator = '. ';

        $request->add($this->getRoleRequest());
        $request->add($this->getResponsibilitiesRequest());

        return $request;
    }

    private function getRoleRequest(): LocalizeRequest
    {
        $request = new LocalizeRequest();
        $role = $this->role->value;
        $specialization = $this->specialization->value;

        $request->add('position.role_label', separator: ': ');

        if ($this->specialization->isset()) {
            $request->add("position.specialization.$specialization");
        }

        $request->add("position.role.$role");

        return $request;
    }

    private function getResponsibilitiesRequest(): LocalizeRequest
    {
        $request = new LocalizeRequest();

        $request->add('position.responsibilities_label', separator: ': ', case: LettersCaseEnum::UPPER_FIRST);

        foreach ($this->responsibilities as $responsibility) {
            $request->add("position.responsibilities.$responsibility->value", separator: ', ');
        }

        return $request;
    }
}

<?php

declare(strict_types=1);

namespace Architecture\Domains\User\Localizations;

class LocalizeGroupRequest
{
    public string $groupsSeparator = ', ';
    private array $groups = [];

    public function add(LocalizeRequest $localizeRequest): void
    {
        $this->groups[] = $localizeRequest;
    }

    /**
     * @return array|LocalizeRequest[]|array<LocalizeRequest>
     */
    public function getGroups(): array
    {
        return $this->groups;
    }
}

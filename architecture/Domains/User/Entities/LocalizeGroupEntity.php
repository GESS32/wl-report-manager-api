<?php

declare(strict_types=1);

namespace Architecture\Domains\User\Entities;

class LocalizeGroupEntity
{
    public string $groupsSeparator = ', ';
    private array $groups = [];

    public function __construct(public readonly string $id) {}

    public function add(LocalizeEntity $localizeRequest): void
    {
        $this->groups[] = $localizeRequest;
    }

    /**
     * @return array|LocalizeEntity[]|array<LocalizeEntity>
     */
    public function getGroups(): array
    {
        return $this->groups;
    }
}

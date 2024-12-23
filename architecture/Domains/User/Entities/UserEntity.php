<?php

declare(strict_types=1);

namespace Architecture\Domains\User\Entities;

use Architecture\Domains\User\Localizations\LocalizationInterface;
use Architecture\Domains\User\ValueObjects\Identifier;
use Architecture\Domains\User\ValueObjects\Position;
use Architecture\Domains\User\ValueObjects\Rank;

class UserEntity
{
    public function __construct(
        public readonly Identifier $id,
        public Rank $rank,
        public Position $position,
    ) {}

    public function getBio(LocalizationInterface $localization): string
    {
        return implode(', ', [
            $localization->translate($this->position),
            $localization->translate($this->rank),
        ]);
    }
}

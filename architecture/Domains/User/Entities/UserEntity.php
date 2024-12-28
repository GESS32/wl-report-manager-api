<?php

declare(strict_types=1);

namespace Architecture\Domains\User\Entities;

use Architecture\Domains\User\Services\LocalizationServiceInterface;
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

    public function getBio(
        LocalizationServiceInterface $localization,
        string $separator = '. ',
        ?string $lang = null
    ): string {
        return implode($separator, [
            $localization->translate($this->position, $lang),
            $localization->translate($this->rank, $lang),
        ]);
    }
}

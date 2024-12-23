<?php

declare(strict_types=1);

namespace Architecture\Domains\User\ValueObjects;

use Architecture\Domains\User\Enums\ResponsibilitiesEnum;
use Architecture\Domains\User\Enums\RoleEnum;
use Architecture\Domains\User\Localizations\LocalizeRequest;
use Architecture\Domains\User\Localizations\TranslatableInterface;

readonly class Position implements TranslatableInterface
{
    public array $responsibilities;

    public function __construct(public RoleEnum $role, array $responsibilities)
    {
        foreach ($responsibilities as $responsibility) {
            $this->responsibilities[] = $responsibility instanceof ResponsibilitiesEnum
                ? $responsibility
                : ResponsibilitiesEnum::from($responsibility);
        }
    }

    public function getLocalizeRequest(): LocalizeRequest
    {
        $request = new LocalizeRequest('position');

        $request->add('role', $this->role->value);

        foreach ($this->responsibilities as $responsibility) {
            $request->add('responsibilities', $responsibility->value);
        }

        return $request;
    }
}

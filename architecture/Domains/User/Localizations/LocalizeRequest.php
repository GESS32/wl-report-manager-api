<?php

declare(strict_types=1);

namespace Architecture\Domains\User\Localizations;

use Architecture\Domains\User\Enums\LettersCaseEnum;

class LocalizeRequest
{
    public string $itemsSeparator = '';
    private array $items = [];

    public function add(
        string $key,
        array $replace = [],
        string $separator = ' ',
        LettersCaseEnum $case = LettersCaseEnum::DEFAULT
    ): void {
        $this->items[] = [
            'key' => $key,
            'replace' => $replace,
            'separator' => $separator,
            'case' => $case,
        ];
    }

    public function count(): int
    {
        return count($this->items);
    }

    /**
     * @return array<array{key: string, replace: array, separator: string, case: LettersCaseEnum}>
     *      An array of items, where each item is an associative array containing:
     *      - 'key' (string): The localization string key.
     *      - 'replace' (array): The replacement variables for the localization string.
     *      - 'separator' (string): The separator for the localization string.
     *      - 'case' (LettersCaseEnum): The case for the localization string.
     */
    public function getItems(): array
    {
        return $this->items;
    }
}

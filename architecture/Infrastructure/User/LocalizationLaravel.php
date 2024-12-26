<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\User;

use Architecture\Domains\User\Enums\LettersCaseEnum;
use Architecture\Domains\User\Localizations\LocalizationInterface;
use Architecture\Domains\User\Localizations\TranslatableInterface;

class LocalizationLaravel implements LocalizationInterface
{
    public function translate(TranslatableInterface $translatable, ?string $locale = null): string
    {
        $response = [];
        $groupRequest = $translatable->getLocalizeRequest();

        foreach ($groupRequest->getGroups() as $request) {
            $responsePart = [];
            $itemsCount = $request->count();
            $loop = 1;

            foreach ($request->getItems() as $item) {
                $translated = trans($item['key'], $item['replace'], $locale);

                $responsePart[] = match ($item['case']) {
                    LettersCaseEnum::UPPER => mb_strtoupper($translated),
                    LettersCaseEnum::LOWER => mb_strtolower($translated),
                    LettersCaseEnum::UPPER_FIRST => mb_ucfirst($translated),
                    LettersCaseEnum::LOWER_FIRST => mb_lcfirst($translated),
                    LettersCaseEnum::UPPER_WORDS => mb_convert_case($translated, MB_CASE_UPPER),
                    default => $translated,
                };

                if ($loop++ < $itemsCount) {
                    $responsePart[] = $item['separator'];
                }
            }

            $response[] = implode($request->itemsSeparator, $responsePart);
        }

        return implode($groupRequest->groupsSeparator, $response);
    }
}

<?php

declare(strict_types=1);

namespace Architecture\Application\Report;

use Architecture\Domains\Prompt\Entities\Report;
use Architecture\Domains\Prompt\Repositories\ReportRepositoryInterface;
use Architecture\Domains\Prompt\Services\TranslatorServiceInterface;
use Architecture\Domains\User\Services\LocalizationServiceInterface;
use RuntimeException;

readonly class CreateHandler
{
    public function __construct(
        private ReportRepositoryInterface $repository,
        private TranslatorServiceInterface $translator,
        private LocalizationServiceInterface $localization
    ) {}

    /**
     * @throws RuntimeException
     */
    public function execute(CreateCommand $request): string
    {
        $report = new Report(
            $this->translator,
            $request->template,
            $request->lang,
            $request->user->getBio($this->localization, lang: $request->lang),
            $request->task,
            $request->description,
            $request->spendTime
        );

        $response = $this->repository->send($report);

        if ($response->isFailure()) {
            throw new RuntimeException('Failed to send report');
        }

        return $response->body;
    }
}

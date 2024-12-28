<?php

declare(strict_types=1);

namespace App\Providers;

use Architecture\Domains\Prompt\Repositories\ReportRepositoryInterface;
use Architecture\Domains\Prompt\Services\TranslatorServiceInterface;
use Architecture\Infrastructure\Persistence\Repositories\ReportRepositoryGemini;
use Architecture\Infrastructure\Services\PromptTranslatorService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class DomainPromptProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(TranslatorServiceInterface::class, PromptTranslatorService::class);
        $this->app->bind(ReportRepositoryInterface::class, ReportRepositoryGemini::class);
    }

    public function provides(): array
    {
        return [
            TranslatorServiceInterface::class,
            ReportRepositoryInterface::class,
        ];
    }
}

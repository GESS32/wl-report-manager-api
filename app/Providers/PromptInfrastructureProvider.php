<?php

declare(strict_types=1);

namespace App\Providers;

use Architecture\Domains\Prompt\Repositories\ReportRepositoryInterface;
use Architecture\Domains\Prompt\Translators\TranslatorInterface;
use Architecture\Infrastructure\Report\ReportRepositoryChatGpt;
use Architecture\Infrastructure\Report\TranslatorLaravel;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class PromptInfrastructureProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(TranslatorInterface::class, TranslatorLaravel::class);
        $this->app->bind(ReportRepositoryInterface::class, ReportRepositoryChatGpt::class);
    }

    public function provides(): array
    {
        return [
            TranslatorInterface::class,
            ReportRepositoryInterface::class,
        ];
    }
}

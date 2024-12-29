<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Persistence\Repositories;

use Architecture\Domains\Prompt\Entities\Report;
use Architecture\Domains\Prompt\Repositories\ReportRepositoryInterface;
use Architecture\Domains\Prompt\ValueObjects\PromptResponse;
use Architecture\Infrastructure\Adapters\ConfigAdapterInterface;
use Gemini\Data\GenerationConfig;
use Gemini\Enums\ModelType;
use Gemini\Laravel\Facades\Gemini;

readonly class ReportRepositoryGemini implements ReportRepositoryInterface
{
    public function __construct(private ConfigAdapterInterface $config) {}

    public function send(Report $report): PromptResponse
    {
        $model = ModelType::from($this->config->get('gemini.model'));
        $client = Gemini::generativeModel($model);

        $generationConfig = new GenerationConfig(
            maxOutputTokens: $this->config->get('gemini.max_tokens'),
            temperature: $this->config->get('gemini.temperature'),
            topP: $this->config->get('gemini.top_p'),
        );

        $response = $client
            ->withGenerationConfig($generationConfig)
            ->generateContent((string) $report);

        return new PromptResponse($response->text(), 200);
    }
}

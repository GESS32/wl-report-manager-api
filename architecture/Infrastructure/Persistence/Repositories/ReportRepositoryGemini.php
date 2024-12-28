<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Persistence\Repositories;

use Architecture\Domains\Prompt\Entities\Report;
use Architecture\Domains\Prompt\Repositories\ReportRepositoryInterface;
use Architecture\Domains\Prompt\ValueObjects\PromptResponse;
use Gemini\Data\GenerationConfig;
use Gemini\Enums\ModelType;
use Gemini\Laravel\Facades\Gemini;

class ReportRepositoryGemini implements ReportRepositoryInterface
{
    public function send(Report $report): PromptResponse
    {
        $model = ModelType::from(config('gemini.model'));
        $client = Gemini::generativeModel($model);

        $generationConfig = new GenerationConfig(
            maxOutputTokens: config('gemini.max_tokens'),
            temperature: config('gemini.temperature'),
            topP: config('gemini.top_p'),
        );

        $response = $client
            ->withGenerationConfig($generationConfig)
            ->generateContent((string) $report);

        return new PromptResponse($response->text(), 200);
    }
}

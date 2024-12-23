<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Report;

use Architecture\Domains\Prompt\Entities\Report;
use Architecture\Domains\Prompt\Repositories\ReportRepositoryInterface;
use Architecture\Domains\Prompt\ValueObjects\PromptResponse;
use OpenAI\Laravel\Facades\OpenAI;

class ReportRepositoryChatGpt implements ReportRepositoryInterface
{
    public function send(Report $report): PromptResponse
    {
        $response = OpenAI::completions()->create([
            'model' => config('openai.model'),
            'prompt' => (string) $report,
            'max_tokens' => config('openai.max_tokens'),
            'temperature' => config('openai.temperature'),
        ]);

        return new PromptResponse($response['choices'][0]['text'], 200);
    }
}

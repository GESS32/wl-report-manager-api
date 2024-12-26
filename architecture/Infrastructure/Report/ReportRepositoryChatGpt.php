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
        dd((string) $report);

        $response = OpenAI::chat()->create([
            'model' => config('openai.model'),
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a professional assistant for generating work reports in IT.'
                ],
                [
                    'role' => 'user',
                    'content' => (string) $report,
                ],
            ],
            'max_tokens' => config('openai.max_tokens'),
            'temperature' => config('openai.temperature'),
        ]);

        return new PromptResponse($response['choices'][0]['message']['content'], 200);
    }
}

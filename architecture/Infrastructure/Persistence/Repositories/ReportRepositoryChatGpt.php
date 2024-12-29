<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Persistence\Repositories;

use Architecture\Domains\Prompt\Entities\Report;
use Architecture\Domains\Prompt\Repositories\ReportRepositoryInterface;
use Architecture\Domains\Prompt\ValueObjects\PromptResponse;
use Architecture\Infrastructure\Adapters\ConfigAdapterInterface;
use OpenAI\Laravel\Facades\OpenAI;

readonly class ReportRepositoryChatGpt implements ReportRepositoryInterface
{
    public function __construct(private ConfigAdapterInterface $config) {}

    public function send(Report $report): PromptResponse
    {
        $response = OpenAI::chat()->create([
            'model' => $this->config->get('openai.model'),
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
            'max_tokens' => $this->config->get('openai.max_tokens'),
            'temperature' => $this->config->get('openai.temperature'),
        ]);

        return new PromptResponse($response['choices'][0]['message']['content'], 200);
    }
}

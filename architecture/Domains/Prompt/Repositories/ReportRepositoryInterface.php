<?php

declare(strict_types=1);

namespace Architecture\Domains\Prompt\Repositories;

use Architecture\Domains\Prompt\Entities\Report;
use Architecture\Domains\Prompt\ValueObjects\PromptResponse;

interface ReportRepositoryInterface
{
    public function send(Report $report): PromptResponse;
}

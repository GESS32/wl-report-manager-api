<?php

declare(strict_types=1);

namespace Architecture\Domains\Prompt\Entities;

use Architecture\Domains\Prompt\Translators\TranslatorInterface;
use Stringable;

class Report implements Stringable
{
    public function __construct(
        public TranslatorInterface $translator,
        public string $translateKey,
        public string $lang,
        public string $person,
        public string $task,
        public string $description,
        public string $spentTime,
    ){}

    public function __toString(): string
    {
        return $this->translator->translate($this->translateKey, [
            'lang' => $this->lang,
            'person' => $this->person,
            'task' => $this->task,
            'description' => $this->description,
            'spent_time' => $this->spentTime,
        ], $this->lang);
    }
}

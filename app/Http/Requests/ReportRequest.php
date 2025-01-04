<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Architecture\Application\Report\CreateCommand;
use Architecture\Domains\User\Entities\UserEntity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReportRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'task' => [
                'required',
                'string',
            ],
            'description' => [
                'required',
                'string',
            ],
            'time' => [
                'required',
                'string',
            ],
            'lang' => [
                'required',
                'string',
                Rule::in(['en', 'ru']),
            ],
        ];
    }

    public function toDto(UserEntity $user): CreateCommand
    {
        return new CreateCommand(
            $user,
            $this->request->get('task'),
            $this->request->get('description'),
            $this->request->get('time'),
            $this->request->get('lang'),
            config('prompt.report.template'),
        );
    }
}

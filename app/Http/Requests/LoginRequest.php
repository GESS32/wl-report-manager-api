<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Architecture\Application\Auth\LoginCommand;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nickname' => 'required',
            'password' => 'required',
        ];
    }

    public function toCommand(): LoginCommand
    {
        return new LoginCommand(
            $this->request->get('nickname'),
            $this->request->get('password'),
        );
    }
}

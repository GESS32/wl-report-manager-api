<?php

declare(strict_types=1);

namespace App\Http\Requests;

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

    public function getNicknameAttribute(): string
    {
        return $this->request->get('nickname');
    }

    public function getPasswordAttribute(): string
    {
        return $this->request->get('password');
    }
}

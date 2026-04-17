<?php

namespace App\Presentation\Http\Requests\Backend\Auth;

use App\UseCases\Auth\DataTransferObjects\BackendLoginData;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
            'remember' => ['nullable', 'boolean'],
        ];
    }

    public function toDto(): BackendLoginData
    {
        /** @var array{username:string,password:string,remember?:bool} $validated */
        $validated = $this->validated();

        return BackendLoginData::fromArray($validated);
    }
}

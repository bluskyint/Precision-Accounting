<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('users')->ignore($this->user)
            ],
            'email' => ['required','string','email','max:100',Rule::unique('users')->ignore($this->user)],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'job_title' => 'required|string|max:255',
            'role_id'    => 'required|exists:roles,id',
            'active'    => ['required', Rule::in([0, 1])],
            'img.src'    => 'nullable|mimes:webp|max:2048',
            'img.alt'    => 'required|string|max:255',
        ];
    }
}

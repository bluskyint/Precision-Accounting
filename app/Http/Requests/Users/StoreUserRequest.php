<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|max:100|unique:users',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
            'job_title' => 'required|string|max:255',
            'role_id'    => 'required|exists:roles,id',
            'img.src'    => 'required|mimes:webp|max:2048',
            'img.alt'    => 'required|string|max:255',
        ];
    }
}

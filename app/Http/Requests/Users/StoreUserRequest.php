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
            'slug' => 'required|string|max:255|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/|unique:users',
            'linkedin' => 'required|string|url|max:255',
            'job_title' => 'required|string|max:255',
            'info'       => 'required|string',
            'role_id'    => 'required|exists:roles,id',
            'img.src'    => 'required|mimes:webp|max:2048',
            'img.alt'    => 'required|string|max:255',
        ];
    }
}

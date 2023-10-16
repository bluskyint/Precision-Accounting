<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
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
            'name'       => 'required|string|max:100|unique:users',
            'slug'       => ['required_if:role_id,2' , 'max:255', Rule::when($this->input('role_id') == '2', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'), 'unique:users'],
            'email'      => 'required|string|email|max:100|unique:users',
            'password'   => ['required', 'confirmed', Password::defaults()],
            'job_title'  => 'required|string|max:255',
            'linkedin'   => 'required_if:role_id,2|url|max:255',
            'info'       => 'required_if:role_id,2|string',
            'seo_title'       => ['nullable' , 'string' , 'max:255'],
            'seo_description' => ['nullable' , 'string'],
            'seo_keywords'    => ['nullable' , 'string'],
            'seo_robots'       => ['nullable' , 'string' , 'max:255'],
            'og_title'       => ['nullable' , 'string' , 'max:255'],
            'og_type'       => ['nullable' , 'string' , 'max:255'],
            'role_id'    => 'required|exists:roles,id',
            'active'     => ['required', Rule::in([0, 1])],
            'img.src'    => 'required|mimes:webp|max:2048',
            'img.alt'    => 'required|string|max:255',
        ];
    }
}

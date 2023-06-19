<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'                 =>  ['required', 'string', 'max:55'],
            'email'                =>  ['required', 'string', 'email', 'max:55'],
            'password'             =>  ['nullable', 'string', 'min:8', 'confirmed'],
            'password_confirmation'=>  ['nullable', 'string', 'min:8'],
        ];
    }
}

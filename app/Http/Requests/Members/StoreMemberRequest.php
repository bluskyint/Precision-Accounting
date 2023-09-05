<?php

namespace App\Http\Requests\Members;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

    class StoreMemberRequest extends FormRequest
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
            'name'            => ['required' , 'string' , 'max:100' , 'unique:members'],
            'slug'           => ['required' , 'string' , 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', 'unique:members'],
            'job_title'       => ['required' , 'string' , 'max:100'],
            'linkedin'       => ['required' , 'string' , 'url', 'max:255'],
            'info'       => ['required', 'string'],
            'slider_show'     => ['required' , 'string' , 'max:1'],
            'img.src'             => 'required|mimes:webp|max:2048',
            'img.alt'             => 'required|string|max:255',
        ];
    }
}

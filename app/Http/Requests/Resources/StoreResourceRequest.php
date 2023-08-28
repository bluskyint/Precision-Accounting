<?php

namespace App\Http\Requests\Resources;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

    class StoreResourceRequest extends FormRequest
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
            'title'          => ['required' , 'string' , 'max:100' , 'unique:resources'],
            'content'        => ['required' , 'string' ],
            'img.src'             => 'required|mimes:webp|max:2048',
            'img.alt'             => 'required|string|max:255',
            'slug'           => ['required' , 'string' , 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', 'unique:resources'],
            'subtitle'       => ['required' , 'string' , 'max:255'],
            'summary'        => ['required' , 'string' , 'max:255'],
        ];
    }
}

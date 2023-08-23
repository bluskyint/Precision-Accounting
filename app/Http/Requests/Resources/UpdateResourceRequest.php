<?php

namespace App\Http\Requests\Resources;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateResourceRequest extends FormRequest
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
            'title'          => ['required' , 'string' , 'max:100' , Rule::unique('resources')->ignore($this->resource)],
            'content'        => ['required' , 'string' ],
            'img'            => ['nullable' , 'mimes:jpeg,png,jpg' , 'max:2048', Rule::unique('resources')->ignore($this->resource)],
            'slug'           => ['required' , 'string' , 'max:255', 'regex:/[a-z0-9]-/', 'alpha_dash', Rule::unique('resources')->ignore($this->resource)],
            'subtitle'       => ['required' , 'string' , 'max:255'],
            'summary'        => ['required' , 'string' , 'max:255'],
        ];
    }
}

<?php

namespace App\Http\Requests\Services;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
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
            'title'           => ['required' , 'string' , 'max:100' , 'unique:services'],
            'slug'           => ['required' , 'string' , 'max:255' , 'regex:/[a-z0-9]-/', 'alpha_dash', 'unique:services'],
            'subtitle'           => ['required' , 'string' , 'max:255'],
            'summary'         => ['required' , 'string' , 'max:255'],
            'seo_title'       => ['required' , 'string' , 'max:500'],
            'seo_description' => ['required' , 'string' , 'max:1000'],
            'seo_keywords'    => ['required' , 'string' , 'max:1000'],
            'parent_id'       => ['nullable' , 'numeric' , 'digits_between:1,11' ],
            'content'         => ['required' , 'string' ],
            'icon'            => ['required' , 'mimes:jpeg,png,jpg,webp' , 'max:2048'],
            'img'             => ['required' , 'mimes:webp' , 'max:2048'],
        ];
    }
}

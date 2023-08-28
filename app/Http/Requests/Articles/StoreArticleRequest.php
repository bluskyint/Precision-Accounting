<?php

namespace App\Http\Requests\Articles;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

    class StoreArticleRequest extends FormRequest
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
            'title'           => ['required' , 'string' , 'max:100' , 'unique:articles'],
            'slug'           => ['required' , 'string' , 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', 'unique:articles'],
            'subtitle'       => ['required' , 'string' , 'max:255'],
            'summary'        => ['required' , 'string' , 'max:255'],
            'content'         => ['required' , 'string' ],
            'seo_title'       => ['required' , 'string' , 'max:500'],
            'seo_description' => ['required' , 'string' , 'max:1000'],
            'seo_keywords'    => ['required' , 'string' , 'max:1000'],
            'author_id'          => ['required' , 'exists:authors,id'],
            'pinned'          => ['required' , 'string' , 'max:1'],
            'category_id'     => ['required' , 'numeric'],
            'img.src'             => ['required' , 'mimes:webp' , 'max:2048'],
            'img.alt'             => ['required' , 'string' , 'max:255'],
        ];
    }
}

<?php

namespace App\Http\Requests\Articles;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
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
            'title'           => ['required' , 'string' , 'max:100' , Rule::unique('articles')->ignore($this->article)],
            'slug'           => ['required' , 'string' , 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', Rule::unique('articles')->ignore($this->article)],
            'subtitle'       => ['required' , 'string' , 'max:255'],
            'summary'        => ['required' , 'string' , 'max:255'],
            'content'         => ['required' , 'string' ],
            'seo_title'       => ['required' , 'string' , 'max:500'],
            'seo_description' => ['required' , 'string'],
            'seo_keywords'    => ['required' , 'string'],
            'seo_robots'       => ['required' , 'string' , 'max:255'],
            'og_title'       => ['required' , 'string' , 'max:255'],
            'og_type'       => ['required' , 'string' , 'max:255'],
            'author_id'          => ['required' , 'exists:users,id'],
            'pinned'          => ['required' , 'string' , 'max:1'],
            'category_id'     => ['required' , 'numeric'],
            'img.src'             => ['nullable' , 'mimes:webp' , 'max:2048'],
            'img.alt'             => ['required' , 'string' , 'max:255'],
        ];
    }
}

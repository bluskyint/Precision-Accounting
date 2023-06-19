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
            'title'           => ['required' , 'string' , 'max:100' , Rule::unique('articles', 'title')->ignore($this->article)],
            'content'         => ['required' , 'string' ],
            'seo_title'       => ['required' , 'string' , 'max:500'],
            'seo_description' => ['required' , 'string' , 'max:1000'],
            'seo_keywords'    => ['required' , 'string' , 'max:1000'],
            'author'          => ['required' , 'string' , 'max:55'],
            'pinned'          => ['required' , 'string' , 'max:1'],
            'category_id'     => ['required' , 'numeric'],
            'img'             => ['required' , 'mimes:jpeg,png,jpg' , 'max:2048'],
        ];
    }
}

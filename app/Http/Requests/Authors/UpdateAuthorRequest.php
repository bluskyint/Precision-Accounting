<?php

namespace App\Http\Requests\Authors;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAuthorRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('authors')->ignore($this->author)
            ],
            'slug' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('authors')->ignore($this->author)],
            'linkedin' => 'required|url|max:255',
            'job_title' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:webp|max:2048'
        ];
    }
}

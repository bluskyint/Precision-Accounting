<?php

namespace App\Http\Requests\Testimonials;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTestimonialRequest extends FormRequest
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
            'name'           => ['required' , 'string' , 'max:100' , Rule::unique('testimonials')->ignore($this->testimonial)],
            'job_title'      => ['nullable' , 'string' , 'max:100' ],
            'visibility'     => ['required' , 'integer' , 'max:1' ],
            'content'        => ['required' , 'string' , 'max:1000'],
            'img'             => 'nullable|mimes:webp|max:2048',
        ];
    }
}

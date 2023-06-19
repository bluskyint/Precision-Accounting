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
            'name'            => ['required' , 'string' , 'max:100' , Rule::unique('members', 'name')->ignore($this->member)],
            'job_title'       => ['required' , 'string' , 'max:100'],
            'slider_show'     => ['required' , 'string' , 'max:1'],
            'img'             => ['required' , 'mimes:jpeg,png,jpg' , 'max:2048'],
        ];
    }
}

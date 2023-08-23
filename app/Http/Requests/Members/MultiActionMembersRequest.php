<?php

namespace App\Http\Requests\Members;

use Illuminate\Foundation\Http\FormRequest;

class MultiActionMembersRequest extends FormRequest
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
            "action" => 'required|string',
            "id" => 'required|exists:members'
        ];
    }
}

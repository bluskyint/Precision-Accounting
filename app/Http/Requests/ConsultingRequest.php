<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsultingRequest extends FormRequest
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
            'first_name'       => ['required' , 'string' , 'max:55' ],
            'last_name'        => ['required' , 'string' , 'max:55' ],
            'phone'            => ['required' , 'string' , 'max:55' ],
            'email'            => ['required' , 'email' , 'max:55' ],
            'address'          => ['required' , 'string', 'max:255' ],
            'business_service' => ['required' , 'string', 'max:100' ],
            'business_type'    => ['required' , 'string', 'max:100' ],
            'state'            => ['required' , 'string', 'max:55' ],
            'meeting'          => ['required' , 'string', 'max:55' ],
            'messege'          => ['required' , 'string', 'max:1000' ],
        ];
    }
}

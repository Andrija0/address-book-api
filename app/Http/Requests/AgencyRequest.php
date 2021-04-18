<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgencyRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|required',
            'address' => 'string|required',
            'city_id' => 'exists:cities,id|required',
            'phone_numbers' => 'array|required|min:1',
            'phone_numbers.*' => 'string',
            'email' => 'email|nullable',
            'web' => 'string',
        ];
    }
}

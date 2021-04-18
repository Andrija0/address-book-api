<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'agency_id' => 'exists:agencies,id|required',
            'professions' => 'array|required|min:1',
            'professions.*' => 'exists:professions,id',
            'phone_numbers' => 'array|required|min:1',
            'phone_numbers.*' => 'string',
            'email' => 'email|nullable',
            'web' => 'string|nullable',
            'photo_id' => 'exists:photos,id',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'city' => 'required',
            'skills' => 'nullable',
            'country' => 'required',
            'last_name' => 'required',
            'first_name' => 'required',
            'postal_code' => 'required',
            'date_of_birth' => 'required',
            'email_address' => 'required',
            'contact_number' => 'required',
            'street_address' => 'required',
        ];
    }
}

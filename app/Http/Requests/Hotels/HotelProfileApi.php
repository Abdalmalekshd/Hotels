<?php

namespace App\Http\Requests\Hotels;

use Illuminate\Foundation\Http\FormRequest;
use Axiom\Rules\TelephoneNumber;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class HotelProfileApi extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'          =>'nullable',
            'email'         =>'email|unique:hotels,email,'.$this->id,
            'phone'         =>[new  TelephoneNumber],
            // 'photo'         =>'image',
        ];
    }


    public function messages(): array
    {
        return [
            'name.required'          => __('admin.namereq'),
            'email.required'         =>__('admin.emailreq'),
            'email.email'            =>__('admin.emailformat'),
            'email.unique'           =>__('admin.emailuni'),
            'phone.required'         =>__('admin.phonereq'),
            'validation.telephone_number'=>__('admin.phonenumeric'),
            'photo.required'         =>__('admin.photoreq'),


        ];
    }


    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors(); // Here is your array of errors
        $response = response()->json([
            'message' => 'Invalid data send',
            'details' => $errors->messages(),
        ], 422);
        throw new HttpResponseException($response);
    }
}

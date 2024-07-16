<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class HotelRequest extends FormRequest
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
            'name'          =>'required',
             'email'         =>'required|email|unique:hotels,email,'.$this->id,
             'phone'         =>'required|numeric',
            // 'password'      => 'required|min:8|with',
             'city_id'       =>'required|exists:cities,id',
            'photo'          =>'required',


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
            'phone.numeric'          =>__('admin.phonenumeric'),
            'city_id.required'       =>__('admin.cityidreq'),
            'city_id.exists'         =>__('admin.cityidexis'),
            'photo.required'         =>__('admin.photoreq'),
            'password.required'      =>__('admin.passreq'),
            'password.min'           =>__('admin.passmin')
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
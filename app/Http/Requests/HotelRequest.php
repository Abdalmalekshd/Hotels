<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'photo'         =>'image',


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
}

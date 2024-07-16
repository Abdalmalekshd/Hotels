<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CountryRequest extends FormRequest
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
            'id'        =>'exists:countries,id',
            'name'   =>'required|string|unique:country_translations,name,'.$this->id,

        ];
    }


    public function messages(): array
    {
        return [
            'name.required'          => __('admin.namereq'),
            'name.string'            => __('admin.namestr'),
            'name.unique'            => __('admin.nameuni'),






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
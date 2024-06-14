<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
}

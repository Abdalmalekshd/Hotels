<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPasswordRequest extends FormRequest
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
            'old_pass'=>'required',
            'new_pass'=>'required|min:8|max:12',

        ];
    }



    public function messages(): array
    {
        return [
            'old_pass.required'          => __('hotel.oldpassreq'),
            'new_pass.required'            => __('hotel.newpassreq'),
            'new_pass.min'            => __('hotel.nameuni'),
            'new_pass.max'            => __('hotel.nameuni'),







        ];
    }
}

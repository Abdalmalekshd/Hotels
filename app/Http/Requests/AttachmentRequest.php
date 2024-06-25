<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AttachmentRequest extends FormRequest
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
            'attach_id'         =>'exists:attachments,id',
            'name_en'           =>'required|string|unique:Attachments,name_en,'.$this->id,
            'name_ar'           =>'required|string|unique:Attachments,name_ar,'.$this->id,
            'slug'              =>'required',

        ];
    }



    public function messages(): array
    {
        return [
            'attach_id.exists'       => __('admin.attachexist'),
            'name_en.required'          => __('admin.namereq'),
            'name_en.string'            => __('admin.namestr'),
            'name_en.unique'            => __('admin.nameuni'),
            'name_ar.required'          => __('admin.namereq'),
            'name_ar.string'            => __('admin.namestr'),
            'name_ar.unique'            => __('admin.nameuni'),
            'slug.unique'               => __('admin.slugreq'),

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
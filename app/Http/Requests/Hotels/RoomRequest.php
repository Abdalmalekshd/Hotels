<?php

namespace App\Http\Requests\Hotels;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'id'            =>'nullable|exists:rooms,id',
            'Room_id'       =>'nullable',
            'people_number' =>'nullable|numeric',
            'room_floor'    =>'numeric|nullable',
            'cost'          => 'numeric',
            'hotel_id'      =>'exists:hotels,id',
            'photo'         =>'image',
            'file'          =>'mimes:xlsx',
            'attach'        => 'exists:attachments,name_en',
        ];

    }




    public function messages(): array
    {
        return [
            'Room_id.required'          => __('hotel.roomidreq'),
            'people_number.required'    =>__('hotel.peplenumreq'),
            'people_number.numeric'     =>__('hotel.peplenum_numeric'),

            'room_floor.required'       =>__('hotel.roomfloor_req'),
            'room_floor.numeric'        =>__('hotel.roomfloor_numeric'),
            'cost.required'             =>__('hotel.room_cost'),
            'cost.numeric'              =>__('hotel.roomcost_numeric'),

            'photo.image'               =>__('admin.photoreq'),
            'attach.exists'             =>__('admin.attachexe'),









        ];
    }
}
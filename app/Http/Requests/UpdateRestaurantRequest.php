<?php

namespace App\Http\Requests;

use App\Restaurant;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('restaurant_edit');
    }

    public function rules()
    {
        return [
            'name'          => [
                'required',
            ],
            'email'         => [
                'required',
            ],
            'code'          => [
                'required',
            ],
            'phone_number'  => [
                'required',
            ],
            'description'   => [
                'required',
            ],
            'file_name'   => [
                ''
            ],
        ];
    }
}

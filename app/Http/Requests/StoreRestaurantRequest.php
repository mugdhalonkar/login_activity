<?php

namespace App\Http\Requests;

use App\Restaurant;
use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('restaurant_create');
    }

    public function rules()
    {
        return [
            'name'          => [
                'required',
            ],
            'email'         => [
                'required',
                'email'
            ],
            'code'          => [
                'required',
            ],
            'phone_number'  => [
                'required',
                'digits:10',
            ],
            'description'   => [
                'required',
            ],
            'file_name'   => [
                'required',
                'mimes:jpg,jpeg,png',
                'file'
            ],
        ];
    }
}

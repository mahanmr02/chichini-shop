<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required|min:2|regex:/^[ا-یa-zA-Z0-9۰-۹ء-ي.,\ ]+$/u',
            'description'=>'min:2|regex:/^[ا-یa-zA-Z0-9۰-۹ء-ي.,\ ]+$/u',
            'keywords'=>'min:2|regex:/^[ا-یa-zA-Z0-9۰-۹ء-ي.,\ ]+$/u',
            'logo'=>'image|mimes:jpg,jpeg,png',
            'icon'=>'image|mimes:jpg,jpeg,png'
        ];
    }
}

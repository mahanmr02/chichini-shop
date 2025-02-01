<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class PostCategoryRequest extends FormRequest
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
        if($this->isMethod('post')){
            return [
                'name'=>'required|min:2|regex:/^[ا-یa-zA-Z0-9۰-۹ء-ي.,\ ]+$/u',
                'description'=>'required|max:500|min:5|regex:/^[ا-یa-zA-Z0-9۰-۹ء-ي.,\ <>\/;\n\r&]+$/u',
                'image'=>'required|image|mimes:jpg,jpeg,png',
                'status'=>'required|numeric|in:0,1',
                'tags'=>'required|regex:/^[ا-یa-zA-Z0-9۰-۹ء-ي.,\ ]+$/u'
            ];
        }
        else{
            return [
                'name'=>'required|min:2|regex:/^[ا-یa-zA-Z0-9۰-۹ء-ي.,\ ]+$/u',
                'description'=>'required|max:500|min:5|regex:/^[ا-یa-zA-Z0-9۰-۹ء-ي.,\ <>\/;\n\r&]+$/u',
                'image'=>'image|mimes:jpg,jpeg,png',
                'status'=>'required|numeric|in:0,1',
                'tags'=>'required|regex:/^[ا-یa-zA-Z0-9۰-۹ء-ي.,\ ]+$/u'
            ];
        }

    }
}

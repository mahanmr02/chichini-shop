<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
                'title'=>'required|min:2|regex:/^[ا-یa-zA-Z0-9۰-۹ء-ي.,\ ]+$/u',
                'summary'=>'required|max:300|min:5|regex:/^[ا-یa-zA-Z0-9۰-۹ء-ي.,\ <>\/;\n\r&]+$/u',
                'body'=>'required|max:600|min:5|regex:/^[ا-یa-zA-Z0-9۰-۹ء-ي.,\ <>\/;\n\r&]+$/u',
                'category_id'=>'required|min:1|regex:/^[0-9]+$/u|exists:post_categories,id',
                'image'=>'required|image|mimes:jpg,jpeg,png,gif',
                'status'=>'required|numeric|in:0,1',
                'tags'=>'required|regex:/^[ا-یa-zA-Z0-9۰-۹ء-ي.,\ ]+$/u',
                'published_at' => 'required|numeric',
            ];
        }
        else{
            return [
                'title'=>'required|min:2|regex:/^[ا-یa-zA-Z0-9۰-۹ء-ي.,\ ]+$/u',
                'summary'=>'required|max:300|min:5|regex:/^[ا-یa-zA-Z0-9۰-۹ء-ي.,\ <>\/;\n\r&]+$/u',
                'body'=>'required|max:600|min:5|regex:/^[ا-یa-zA-Z0-9۰-۹ء-ي.,\ <>\/;\n\r&]+$/u',
                'category_id'=>'required|min:1|regex:/^[0-9]+$/u|exists:post_categories,id',
                'image'=>'image|mimes:jpg,jpeg,png,gif',
                'status'=>'required|numeric|in:0,1',
                'tags'=>'required|regex:/^[ا-یa-zA-Z0-9۰-۹ء-ي.,\ ]+$/u',
                'published_at' => 'numeric',
            ];
        } 
    }
}
<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                'introduction'=>'required|max:1000|min:5    ',
                'image'=>'required|image|mimes:jpg,jpeg,png',
                'status'=>'required|numeric|in:0,1',
                'marketable'=>'required|numeric|in:0,1',
                'tags'=>'required|regex:/^[ا-یa-zA-Z0-9۰-۹ء-ي.,\ ]+$/u',
                'weight'=>'required|numeric',
                'width'=>'required|numeric',
                'height'=>'required|numeric',
                'length'=>'required|numeric',
                'price'=>'required|integer|numeric',
                'category_id'=>'required|min:1|regex:/^[0-9]+$/u|exists:product_categories,id',
                'brand_id'=>'required|min:1|regex:/^[0-9]+$/u|exists:brands,id',
                'published_at'=>'required|numeric',
                'meta_key.*' => 'required',
                'meta_value.*' => 'required'

            ];
        }
        else{
            return [
                'name'=>'required|min:2|regex:/^[ا-یa-zA-Z0-9۰-۹ء-ي.,\ ]+$/u',
                'introduction'=>'required|max:1000|min:5    ',
                'image'=>'image|mimes:jpg,jpeg,png',
                'status'=>'required|numeric|in:0,1',
                'marketable'=>'required|numeric|in:0,1',
                'tags'=>'required|regex:/^[ا-یa-zA-Z0-9۰-۹ء-ي.,\ ]+$/u',
                'weight'=>'required|numeric',
                'width'=>'required|numeric',
                'height'=>'required|numeric',
                'length'=>'required|numeric',
                'price'=>'required|numeric',
                'category_id'=>'required|min:1|regex:/^[0-9]+$/u|exists:product_categories,id',
                'brand_id'=>'required|min:1|regex:/^[0-9]+$/u|exists:brands,id',
                'published_at'=>'required|numeric',
                'meta_key.*' => 'required',
                'meta_value.*' => 'required'
            ];
        }
    }
    public function attributes()
    {
        return [
            'meta_key.*' => 'ویژگی',
            'meta_value.*' => 'مقدار'
        ];
    }
}

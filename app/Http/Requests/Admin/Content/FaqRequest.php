<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
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
                'question' => 'required|min:5|regex:/^[ا-یa-zA-Z0-9۰-۹\ء-ي.,\s]*[?؟]$/u',
                'answer' => 'required|max:100000|min:5|regex:/^[ا-یa-zA-Z0-9۰-۹ء-ي.,\ <>\/;\n\r&?؟]+$/u',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9۰-۹ء-ي.,_\s]+$/u',
            ];
        
    }
}

<?php

namespace App\Http\Requests\Admin\Ticket;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'answer' => 'required|regex:/^[ا-یa-zA-Z0-9۰-۹ء-ي.,_\s]+$/u|min:2|max:1400'
        ];
    }
}

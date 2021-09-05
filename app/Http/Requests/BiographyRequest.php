<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class BiographyRequest extends FormRequest
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
            'biography' => 'between:0,500'
        ];
    }
}

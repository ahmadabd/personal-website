<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title'         => 'required|string',
            'descriptions'  => 'required|string',
            'url'           => 'nullable|url',
            'book_picture'  => 'nullable|image|max:10240'
        ];

    }

    public function messages()
    {
        return [
            'book_picture.max' => 'File must not be greater than 10 MB' 
        ];
    }
}

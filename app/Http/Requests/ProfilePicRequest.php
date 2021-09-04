<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ProfilePicRequest extends FormRequest
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
            'profilePic' => 'required|image|max:10240'
        ];
    }

    public function messages()
    {
        return [
            'profilePic.max' => 'The resume file must not be greater than 10 MB' 
        ];
    }
}

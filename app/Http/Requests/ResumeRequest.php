<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ResumeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'resumeFile' => 'required|mimes:pdf|max:10240'
        ];
    }

    public function messages()
    {
        return [
            'resumeFile.max' => 'The resume file must not be greater than 10 MB' 
        ];
    }
}

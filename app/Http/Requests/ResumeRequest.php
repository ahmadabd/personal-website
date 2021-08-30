<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ResumeRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::user();
    }

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

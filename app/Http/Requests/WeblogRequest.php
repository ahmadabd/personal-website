<?php

namespace App\Http\Requests;

use App\Models\Weblog;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class WeblogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->id == Weblog::get()[0]['user_id'];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'weblogUrl' => 'required|url'
        ];
    }
}

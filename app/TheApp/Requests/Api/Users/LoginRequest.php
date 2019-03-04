<?php

namespace App\TheApp\Requests\Api\Users;

use Illuminate\Foundation\Http\FormRequest;
use App\TheApp\Requests\Api\ApiRequest;

class LoginRequest extends ApiRequest
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
             'password'       =>'required',
             'email'          =>'required|email',
        ];
    }

        public function messages()
    {
        return [
            'email.required'        => 'من فضلك قم بادخال البريد الالكتروني',
            'password.required'     => 'من فضلك قم بادخال كلمة المرور',
            'email.email'           => 'من فضلك قم بادخال البريد بشكل صحيح',
        ];
    }
}

<?php

namespace App\TheApp\Requests\Api\Users;

use Illuminate\Foundation\Http\FormRequest;
use App\TheApp\Requests\Api\ApiRequest;

class ChangePassword extends ApiRequest
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
             'old_password' =>'required',
             'new_password' =>'required',
             'user_id'      =>'required',
             'api_token'    =>'required',
        ];
    }

    public function messages()
    {
        return [
            'old_password.required'     => 'من فضلك قم بادخال كلمة المرور القديمة',
            'new_password.required'     => 'من فضلك قم بادخال كلمة المرور الجديدة',
            'user_id.required'          => 'من فضلك ادخ { user_id }',
            'api_token.required'        => 'من فضلك ادخل { api_token }',
        ];
    }
}

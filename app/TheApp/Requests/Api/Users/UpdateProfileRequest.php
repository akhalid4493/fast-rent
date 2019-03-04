<?php

namespace App\TheApp\Requests\Api\Users;

use Illuminate\Foundation\Http\FormRequest;
use App\TheApp\Requests\Api\ApiRequest;

class UpdateProfileRequest extends ApiRequest
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
             'full_name'   => 'required|min:3|max:255|regex:/^[\pL\s\-]+$/u',
             'email'       => 'required|email|unique:users,email,'.$this->user_id,
             'mobile'      => 'required|numeric',
        ];
    }

        public function messages()
    {
        return [
            'full_name.required'   => 'من فضلك ادخل الاسم بالكامل.',
            'full_name.min'        => 'الاسم يجب الا يقل عن ٣ احرف.',
            'full_name.max'        => 'الاسم يجب الا يزيد عن ٢٥٥ حرف.',
            'full_name.regex'      => 'الاسم بالكامل يجب ان يحتوي على احرف فقط.',
            
            'email.required'      => 'من فضلك ادخل البريد الالكتروني.',
            'email.email'         => 'من فضلك ادخل البريد بشكل صحيح { email@example.com }.',
            'email.unique'        => 'هذا البريد الالكتروني موجود بالفعل.',

            'country.required'     => 'من فضلك اختر الدولة ',

            'mobile.required'     => 'من فضلك ادخل رقم الهاتف.',
            'mobile.numeric'      => 'يحب ان يتكون رقم الهاتف من ارقام فقط.',

            'active.required'     => 'من فضلك قم بتحديد التفعيل للعميل.',

            'platform.required'   => 'من فضلك ادخل platform.',
        ];
    }
}

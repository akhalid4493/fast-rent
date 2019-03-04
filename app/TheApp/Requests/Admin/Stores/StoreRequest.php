<?php

namespace App\TheApp\Requests\Admin\Stores;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name_ar'     => 'required|unique:stores,name_ar',
            'name_en'     => 'required|unique:stores,name_en',
            'type'        => 'required',
            'user_id'     => 'required|unique:stores,user_id',
            'status'      => 'required',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2050',
         ];
    }

    public function messages()
    {
        return [

            'name_ar.required'   => 'من فضلك ادخل عنوان المتجر بالعربي',
            'name_ar.unique'     => 'عنوان المتجر بالعربي تم ادخالة من قبل',

            'name_en.required'   => 'من فضلك ادخل عنوان المتجر بالانجليزي',
            'name_en.unique'     => 'المتجر بالانجليزي تم ادخالة من قبل',

            'type.required'      => 'من فضلك قم باختيار نوع المتجر',

            'user_id.required'   => 'من فضلك قم باختيار مالك المتجر',
            'user_id.unique'     => 'هذا الشخص لدية متجر بالفعل',

            'status.required'      => 'من فضلك قم باختيار حالة التفعيل للمتجر',

            'image.image'        => 'هذا الملف ليس صورة',
            'image.mimes'        => 'يجب ان تكون الصوره من نوع [ jpg , png ] .',
            'image.max'          => 'حجم الصوره يجب الا يكون اكبر من  2 MB  للغلاف.',
            
        ];
    }
}

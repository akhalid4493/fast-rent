<?php

namespace App\TheApp\Requests\Admin\Packages;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
            'name_ar'           => 'required|unique:packages,name_ar',
            'name_en'           => 'required|unique:packages,name_en',
            'description_ar'    => 'required',
            'description_en'    => 'required',
            'price'             => 'required',
            'months'            => 'required',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg|max:2050',
         ];
    }

    public function messages()
    {
        return [

            'name_ar.required'       => 'من فضلك ادخل عنوان الباقة بالعربي',
            'name_ar.unique'         => 'عنوان الباقة بالعربي تم ادخالة من قبل',

            'name_en.required'       => 'من فضلك ادخل عنوان الباقة بالانجليزي',
            'name_en.unique'         => 'الباقة بالانجليزي تم ادخالة من قبل',



            'description_ar.required'=> 'من فضلك ادخل وصف الباقة بالعربي',
            'description_en.required'=> 'من فضلك ادخل وصف الباقة بالانجليزي',

            'price.required'        => 'من فضلك قم بادخال سعر الباقة',
            'months.required'       => 'من فضلك قم بادخال اشهر الباقة',

            'image.image'           => 'هذا الملف ليس صورة',
            'image.mimes'           => 'يجب ان تكون الصوره من نوع [ jpg , png ] .',
            'image.max'             => 'حجم الصوره يجب الا يكون اكبر من  2 MB  للغلاف.',
            
        ];
    }
}

<?php

namespace App\TheApp\Requests\Admin\Brands;

use Illuminate\Foundation\Http\FormRequest;

class EditBrandRequest extends FormRequest
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
            'name_ar'     => 'required|unique:brands,name_ar,'.$this->route('brand'),
            'name_en'     => 'required|unique:brands,name_en,'.$this->route('brand'),
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2050',
         ];
    }

    public function messages()
    {
        return [

            'name_ar.required'   => 'من فضلك ادخل عنوان العلامة التجارية بالعربي',
            'name_ar.unique'     => 'عنوان العلامة التجارية بالعربي تم ادخالة من قبل',

            'name_en.required'   => 'من فضلك ادخل عنوان العلامة التجارية بالانجليزي',
            'name_en.unique'     => 'العلامة التجارية بالانجليزي تم ادخالة من قبل',


            'image.image'        => 'هذا الملف ليس صورة',
            'image.mimes'        => 'يجب ان تكون الصوره من نوع [ jpg , png ] .',
            'image.max'          => 'حجم الصوره يجب الا يكون اكبر من  2 MB  للغلاف.',
            
        ];
    }
}

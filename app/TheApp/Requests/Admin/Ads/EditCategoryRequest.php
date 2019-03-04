<?php

namespace App\TheApp\Requests\Admin\Items;

use Illuminate\Foundation\Http\FormRequest;

class EditItemRequest extends FormRequest
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
            'name_ar'     => 'required|unique:categories,name_ar,'.$this->route('category'),
            'name_en'     => 'required|unique:categories,name_en,'.$this->route('category'),
            'category_id' => 'required',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2050',
         ];
    }

    public function messages()
    {
        return [

            'name_ar.required'   => 'من فضلك ادخل عنوان القسم بالعربي',
            'name_ar.unique'     => 'عنوان القسم بالعربي تم ادخالة من قبل',

            'name_en.required'   => 'من فضلك ادخل عنوان القسم بالانجليزي',
            'name_en.unique'     => 'القسم بالانجليزي تم ادخالة من قبل',

            'category_id.required'=> 'من فضلك قم بالتحديد على مستوى القسم',

            'image.image'        => 'هذا الملف ليس صورة',
            'image.mimes'        => 'يجب ان تكون الصوره من نوع [ jpg , png ] .',
            'image.max'          => 'حجم الصوره يجب الا يكون اكبر من  2 MB  للغلاف.',
            
        ];
    }
}

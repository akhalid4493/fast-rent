<?php

namespace App\TheApp\Requests\Admin\Items;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'name'        => 'required',
            'description' => 'required',
            'price'       => 'required|numeric',
            'qty'         => 'required|numeric',
            'store_id'    => 'required',
            'brand_id'    => 'required',
            'category_id' => 'required',
            'status'      => 'required',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2050',
         ];
    }

    public function messages()
    {
        return [

            'name.required'         => 'من فضلك ادخل عنوان المنتج',

            'description.required'  => 'من فضلك ادخل وصف المنتج',

            'price.required'        => 'من فضلك ادخل سعر المنتج',
            'price.numeric'         => 'يجب ان يكون السعر ارقام فقط: 4.500',

            'qty.required'        => 'من فضلك ادخل كمية المنتج',
            'qty.numeric'         => 'يجب ان تكون كمية ارقام فقط: 45',

            'category_id.required'=> 'من فضلك قم بالتحديد على القسم',
            'store_id.required'=> 'من فضلك قم بالتحديد على المتجر',
            'brand_id.required'=> 'من فضلك قم بالتحديد على العلامة التجارية',

            'status.required'      => 'من فضلك قم باختيار حالة التفعيل للمنتج',

            'image.image'        => 'هذا الملف ليس صورة',
            'image.mimes'        => 'يجب ان تكون الصوره من نوع [ jpg , png ] .',
            'image.max'          => 'حجم الصوره يجب الا يكون اكبر من  2 MB  للغلاف.',
            
        ];
    }
}

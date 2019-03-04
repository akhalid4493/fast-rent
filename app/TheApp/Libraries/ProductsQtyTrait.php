<?php
namespace App\TheApp\Libraries;

use App\Models\Product;

trait ProductsQtyTrait
{
    public static function updateQty($data) 
    {
    	foreach ($data as $product) {
    		Product::find($product['product_id'])->decrement('qty', $product['qty']);
    	}
    }
}
<?php

//create a function or any things to use in any were in html or php or laravel also

use App\Models\MainCategory;
use App\Models\Product;
use App\Models\Table;
use App\Models\TableOrder;

if(!function_exists('getMainCategoryById')){
    function getMainCategoryById($id)
    {
        $main = MainCategory::find($id);
        echo "<pre>";
        return $main;
    }
}
if(!function_exists('getTotalByQuantity')){
    function getTotalByQuantity($pid,$qty)
    {
        $price = Product::find($pid)->get()[0]->price;
        return $price * $qty;
    }
}
if(!function_exists('getTableItems')){
    function getTableItems($id)
    {
        $items = Table::with('getItems')->find($id);
        // echo '<pre>';
        // print_r($items);
        return $items;
    }
}
if(!function_exists('getProductById')){
    function getProductById($id)
    {
        $product= Product::find($id);
        return $product;
    }
}

if(!function_exists('getTableTotal')){
    function getTableTotal($items)
    {
        $total = 0;
        foreach ($items as $item) {
            $total = $total + $item['total'];
        }
        return $total;
    }
}
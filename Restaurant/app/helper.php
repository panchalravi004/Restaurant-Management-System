<?php

//create a function or any things to use in any were in html or php or laravel also

use App\Models\MainCategory;

if(!function_exists('getMainCategoryById')){
    function getMainCategoryById($id)
    {
        $main = MainCategory::find($id);
        echo "<pre>";
        return $main;
    }
}
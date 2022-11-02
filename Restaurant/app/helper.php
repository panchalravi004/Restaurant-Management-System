<?php

//create a function or any things to use in any were in html or php or laravel also

use App\Models\MainCategory;
use App\Models\OrderHistory;
use App\Models\Product;
use App\Models\Table;
use App\Models\TableOrder;
use Carbon\Carbon;

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
if(!function_exists('getTableStatus')){
    function getTableStatus($id)
    {
        $item = getTableItems($id)->getItems;
        if($item->count()>0){
            return true;
        }else{
            return false;
        }
    }
}
if(!function_exists('getStatistics')){
    function getStatistics()
    {
        // $date = str_split(Carbon::now(),10)[0];
        // $yearMonth = str_split($date,7)[0];
        // $todayParcel = OrderHistory::where('created_at','LIKE',"%$date%")->where('is_parcel','=',1)->get();
        $todayParcel = OrderHistory::whereDay('created_at',date('d'))->where('is_parcel','=',1)->get();
        $todayOrder = OrderHistory::whereDay('created_at',date('d'))->where('is_parcel','=',0)->get();
        $todayRevenue = OrderHistory::whereDay('created_at',date('d'))->sum('amount');
        $monthRevenue = OrderHistory::whereMonth('created_at',date('m'))->sum('amount');
        $monthOrder = OrderHistory::whereMonth('created_at',date('m'))->get();

        $data = array(
            "todayParcel"=>$todayParcel,
            "todayOrder"=>$todayOrder,
            "todayRevenue"=>$todayRevenue,
            "monthRevenue"=>$monthRevenue,
            "monthOrder"=>$monthOrder
        );
        return $data;
    }
}
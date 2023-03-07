<?php

namespace App\Http\Controllers;

use App\Models\ShefCorner;
use App\Models\TableOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShefCornerController extends Controller
{
    public function index()
    {
        $orders = DB::table('shef_corners')
        ->leftJoin('products','shef_corners.product_id','=','products.id')
        ->leftJoin('tables','shef_corners.table_id','=','tables.id')
        ->select('shef_corners.*','products.name as product_name','tables.name as table_name','tables.section')
        ->orderBy('shef_corners.status','asc')
        ->orderBy('shef_corners.created_at','asc')->get();

        // return $orders;
        $data = compact('orders');
        
        return view('section/shef_corner')->with($data);
    }

    public function updateOrderStatus($status,$id)
    {
        $order = ShefCorner::find($id);
        $order->status = $status;

        $order->save();

        return redirect()->back();
    }
}

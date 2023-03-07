<?php

namespace App\Http\Controllers;

use App\Models\OrderHistory;
use App\Models\Product;
use App\Models\ShefCorner;
use App\Models\Table;
use App\Models\TableOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
class ManageTableController extends Controller
{
    public function index()
    {
        $table = Table::all();
        $product = Product::where('status','=',1)->get();
        $data = compact('table','product');
        return view('section/manage_Table')->with($data);
    }
    public function create(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'section'=>'required'
        ]);
        $table = new Table();
        $table->name = $request['name'];
        $table->section = $request['section'];
        $table->save();
        return redirect()->route('manage_tables');
    }

    public function addItem(Request $request,$table_id)
    {
        $request->validate([
            'product-id'=>'required',
            'quantity'=>'required',
        ]);

        //check product order is already add then update quantity
        $findOrder = TableOrder::where('table_id','=',$table_id)->where('product_id','=',$request['product-id'])->get();
        // return $findOrder;
        if($findOrder->count()>0){
            $createorder = TableOrder::find($findOrder[0]->id);
            $createorder->quantity = $findOrder[0]->quantity + $request['quantity'];
            $createorder->total = getTotalByQuantity($request['product-id'],$findOrder[0]->quantity + $request['quantity']);
            $createorder->save();
        }else{
            $createorder = new TableOrder();
            $createorder->product_id = $request['product-id'];
            $createorder->quantity = $request['quantity'];
            $createorder->table_id = $table_id;
            $createorder->total = getTotalByQuantity($request['product-id'],$request['quantity']);
            $createorder->save();
        }
        $shefCorner = new ShefCorner();
        $shefCorner->product_id = $request['product-id'];
        $shefCorner->quantity = $request['quantity'];
        $shefCorner->table_id = $table_id;
        $shefCorner->save();
        return redirect()->back()->with('ITEM-ACTION',$table_id);
    }

    public function removeItem($id)
    {
        $item = TableOrder::find($id);
        //also update shef corner item quantity
        $shefItem = DB::table('shef_corners')
        ->where('product_id','=',$item->product_id)
        ->where('table_id','=',$item->table_id)
        ->where('status','=','Pending')
        ->select('shef_corners.*')
        ->get();

        $pendingOrderQty = 0;
        foreach ($shefItem as $value) {
            $getItem = ShefCorner::find($value->id);
            $pendingOrderQty += $getItem->quantity;
            $getItem->delete();
        }
        $table_id = $item->table_id;

        if($pendingOrderQty == $item->quantity){
            $item->delete();
        }else{
            $item->quantity = $item->quantity - $pendingOrderQty;
            $item->save();
        }

        return back()->with('ITEM-ACTION',$table_id);;
    }

    public function delete($id)
    {
        $table = Table::find($id);
        $table->delete();
        return redirect()->back();
    }

    public function closeTable(Request $request,$id)
    {
        $items = getTableItems($id);
        $total = getTableTotal($items);
        $table = Table::find($id);

        $createHistory = new OrderHistory();
        $createHistory->amount=$total;
        $createHistory->table_name="TABLE-".$table->name;
        $createHistory->username=Auth::user() != null ? Auth::user()->name : 'Customer' ;
        $createHistory->section=$table->section;

        if (isset($request['is_parcel'])) {
            $createHistory->is_parcel=1;
        }

        if($items->count() > 0){
            $createHistory->save();
        }
        

        //remove items from the table
        foreach ($items as $item) {
            $findOrder = TableOrder::find($item->id);
            $findOrder->delete();
        }
        //remove items from the shef corner table
        $shefCornerItems = ShefCorner::where('table_id','=',$id)->get();
        foreach ($shefCornerItems as $item) {
            $getItem = ShefCorner::find($item->id);
            $getItem->delete();
        }

        return redirect()->back();
    }

    public function manageItem($action,$id)
    {
        $oldItem = TableOrder::find($id);
        //also update shef corner item quantity
        $shefItem = DB::table('shef_corners')
        ->where('product_id','=',$oldItem->product_id)
        ->where('table_id','=',$oldItem->table_id)
        ->where('status','=','Pending')
        ->select('shef_corners.*')
        ->get();

        if ($action == 'INC') {
            $item = TableOrder::find($id);
            $item->quantity = $oldItem->quantity + 1;
            $item->total = getTotalByQuantity($oldItem->product_id,$oldItem->quantity + 1);
            $item->save();

            // return $shefItem;
            if($shefItem->count() > 0){
                $getShefItem = ShefCorner::find($shefItem[0]->id);
                $getShefItem->quantity = $getShefItem->quantity + 1;
                $getShefItem->save();
            }else{
                //if pending order doesnt exists for this product and table 
                //then add new order in shef corner
                $shefCorner = new ShefCorner();
                $shefCorner->product_id = $oldItem->product_id;
                $shefCorner->quantity = 1;
                $shefCorner->table_id = $oldItem->table_id;
                $shefCorner->save();
            }

        }
        elseif ($action == 'DEC') {
            $item = TableOrder::find($id);

            if($item->quantity == 1){
                //also update shef corner item quantity
                if($shefItem->count() > 0){
                    $getShefItem = ShefCorner::find($shefItem[0]->id);
                    $getShefItem->delete();
                    $item->delete();
                }
            }else{
                if($shefItem->count() > 0){
                    //only remove the pending items from table
                    $getShefItem = ShefCorner::find($shefItem[0]->id);

                    if($getShefItem->quantity == 1){
                        $getShefItem->delete();
                    }else{
                        $getShefItem->quantity = $getShefItem->quantity - 1;
                        $getShefItem->save();
                    }

                    $item->quantity = $oldItem->quantity - 1;
                    $item->total = getTotalByQuantity($oldItem->product_id,$oldItem->quantity - 1);
                    $item->save();
                }
            }
        }
        return redirect()->back()->with('ITEM-ACTION',$oldItem->table_id);
    }

    public function billPrint($id)
    {
        $items = getTableItems($id);
        $total = getTableTotal($items);
        $data = compact('items','total');
        // return $items;
        return view("bill/bill")->with($data);
    }
}

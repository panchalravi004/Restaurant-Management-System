<?php

namespace App\Http\Controllers;

use App\Models\OrderHistory;
use App\Models\Product;
use App\Models\Table;
use App\Models\TableOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageTableController extends Controller
{
    public function index()
    {
        $table = Table::all();
        $product = Product::all();
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
        return redirect()->back()->with('ITEM-ACTION',$table_id);
    }

    public function removeItem($id)
    {
        $item = TableOrder::find($id);
        $table_id = $item->table_id;
        $item->delete();
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
        $createHistory->username=Auth::user()->name;
        $createHistory->section=$table->section;

        if (isset($request['is_parcel'])) {
            $createHistory->is_parcel=1;
        }
        $createHistory->save();

        //print bill
        $this->generateInvoice($items);
        //remove items from the table
        foreach ($items as $item) {
            $findOrder = TableOrder::find($item->id);
            $findOrder->delete();
        }

        return redirect()->back();
    }

    public function manageItem($action,$id)
    {
        $oldItem = TableOrder::find($id);
        if ($action == 'INC') {
            $item = TableOrder::find($id);
            $item->quantity = $oldItem->quantity + 1;
            $item->total = getTotalByQuantity($oldItem->product_id,$oldItem->quantity + 1);
            $item->save();
        }
        elseif ($action == 'DEC') {
            $item = TableOrder::find($id);
            if($item->quantity == 1){
                $item->delete();
            }else{
                $item->quantity = $oldItem->quantity - 1;
                $item->total = getTotalByQuantity($oldItem->product_id,$oldItem->quantity - 1);
                $item->save();
            }
        }
        return redirect()->back()->with('ITEM-ACTION',$oldItem->table_id);
    }

    public function generateInvoice($items)
    {
        
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\OrderHistory;
use App\Models\Product;
use App\Models\Table;
use App\Models\TableOrder;
use Illuminate\Http\Request;

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
            'name'=>'required'
        ]);
        $table = new Table();
        $table->name = $request['name'];
        $table->save();
        return redirect()->route('manage_tables');
    }

    public function addItem(Request $request,$table_id)
    {
        $request->validate([
            'product-id'=>'required',
            'quantity'=>'required',
        ]);
        $createorder = new TableOrder();
        $createorder->product_id = $request['product-id'];
        $createorder->quantity = $request['quantity'];
        $createorder->table_id = $table_id;
        $createorder->total = getTotalByQuantity($request['product-id'],$request['quantity']);
        $createorder->save();

        return redirect()->route('manage_tables')->with('ITEM-ACTION',$table_id);
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
        $createHistory->table_name="TABLE_".$table->name;
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

    public function generateInvoice($items)
    {
        
    }
}

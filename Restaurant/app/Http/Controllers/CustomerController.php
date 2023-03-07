<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\ShefCorner;
use App\Models\Table;
use App\Models\TableOrder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

class CustomerController extends Controller
{
    public function index($tableId)
    {

        $table = Table::find($tableId);
        $product = Product::where('status','=',1)->get();

        // return $table;
        $data = compact('table','product');

        return view('customer/customer')->with($data);

    }

    public function generateCode(Request $request)
    {
        $tables = Table::all();
        $host = FacadesRequest::getHost();
        $requestType = $request->isSecure() ? 'https://' : 'http://'; // Get the current request type (http or https)
        $port = $request->getPort(); // Get the current port number

        $data = compact('tables','host','requestType','port');

        return view('customer/qrcode-pdf')->with($data);
    }

    public function placeOrder(Request $request,$table_id)
    {

        foreach (array_keys($request->toArray()) as $key) {
            //check product order is already add then update quantity
            $findOrder = TableOrder::where('table_id','=',$table_id)->where('product_id','=',$request[$key]['id'])->get();
            // return $findOrder;
            if($findOrder->count()>0){
                $createorder = TableOrder::find($findOrder[0]->id);
                $createorder->quantity = $findOrder[0]->quantity + $request[$key]['qty'];
                $createorder->total = getTotalByQuantity($request[$key]['id'],$findOrder[0]->quantity + $request[$key]['qty']);
                $createorder->save();
            }else{
                $createorder = new TableOrder();
                $createorder->product_id = $request[$key]['id'];
                $createorder->quantity = $request[$key]['qty'];
                $createorder->table_id = $table_id;
                $createorder->total = getTotalByQuantity($request[$key]['id'],$request[$key]['qty']);
                $createorder->save();
            }
            $shefCorner = new ShefCorner();
            $shefCorner->product_id = $request[$key]['id'];
            $shefCorner->quantity = $request[$key]['qty'];
            $shefCorner->table_id = $table_id;
            $shefCorner->save();
        }
        //return array_keys($request->toArray());
        // return $request[1];

        return "SUCCESS";

    }
}

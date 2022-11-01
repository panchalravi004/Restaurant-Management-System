<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SubCategory;
use Exception;
use Illuminate\Http\Request;

class ManageProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request['search'] ?? '';
        if ($search != '') {
            $product = Product::with('getSubCategory')->where('name','LIKE',"%$search%")->paginate(10);
        }else{
            $product = Product::with('getSubCategory')->paginate(10);
        }
        $subcategory = SubCategory::all();
        // return $product;
        $data = compact('product','subcategory');
        return view('section/manage_product')->with($data);
    }
    public function create(Request $request)
    {
        $request->validate([
            "code"=>"required",
            "name"=>"required",
            "sub-category-id"=>"required",
            "price"=>"required",
            "discount"=>"required",
            "status"=>"required"
        ]);

        $product = new Product();
        $product->code = $request['code'];
        $product->name = $request['name'];
        $product->sub_category_id = $request['sub-category-id'];
        $product->price = $request['price'];
        $product->discount = $request['discount'];
        $product->status = $request['status'];
        $product->save();

        return redirect()->back();
    }

    public function edit(Request $request,$id)
    {
        $request->validate([
            "code"=>"required",
            "name"=>"required",
            "sub-category-id"=>"required",
            "price"=>"required",
            "discount"=>"required",
            "status"=>"required"
        ]);

        $product = Product::find($id);
        $product->code = $request['code'];
        $product->name = $request['name'];
        $product->sub_category_id = $request['sub-category-id'];
        $product->price = $request['price'];
        $product->discount = $request['discount'];
        $product->status = $request['status'];
        $product->save();

        return redirect()->back();
    }

    public function delete($id)
    {
        try {
            $product = Product::find($id);
            $product->delete();
            return redirect()->back();
        } catch (Exception $th) {
            return redirect()->back()->withError('Content used some where !');
        }
    }
}

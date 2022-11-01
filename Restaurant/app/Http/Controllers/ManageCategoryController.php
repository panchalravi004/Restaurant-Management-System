<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use App\Models\SubCategory;
use Exception;
use Illuminate\Http\Request;

class ManageCategoryController extends Controller
{
    public function index()
    {
        //fetch main category
        $mainCat = MainCategory::all();
        $subCat = SubCategory::with('getMainCategory')->get();
        $data = compact('mainCat','subCat');
        return view('section/manage_category')->with($data);
        // echo '<pre>';
        // print_r($subCat->toArray()[0]['get_main_category'][0]['name']);
        // return SubCategory::with('getMainCategory')->get();
    }
    public function addMainCategory(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);
        $main = new MainCategory();
        $main->name = $request['name'];
        $main->save();
        return redirect()->route('manage_category');
    }
    public function addSubCategory(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'main-category-id'=>'required'
        ]);
        $sub = new SubCategory();
        $sub->name = $request['name'];
        $sub->main_category_id = $request['main-category-id'];
        $sub->save();
        return redirect()->route('manage_category');
    }
    public function editMainCategory(Request $request,$id)
    {
        $request->validate([
            'name'=>'required'
        ]);
        $main = MainCategory::find($id);
        $main->name = $request['name'];
        $main->save();
        return redirect()->route('manage_category');
    }
    public function editSubCategory(Request $request,$id)
    {
        $request->validate([
            'name'=>'required',
            'main-category-id'=>'required'
        ]);
        $sub = SubCategory::find($id);
        $sub->name = $request['name'];
        $sub->main_category_id = $request['main-category-id'];
        $sub->save();
        return redirect()->route('manage_category');
    }

    public function deleteCategory($category,$id)
    {
        if($category == "MAIN"){
            try {
                $cat = MainCategory::find($id);
                $cat->delete();
                return redirect()->back();
            } catch (Exception $th) {
                return redirect()->back()->withError('Content used some where !');
            }
            
        }
        elseif($category == "SUB"){
            try {
                $cat = SubCategory::find($id);
                $cat->delete();
                return redirect()->back();
            } catch (Exception $th) {
                return redirect()->back()->withError('Content used some where !');
            }
        }else{
            return redirect()->back();
        }
    }
}

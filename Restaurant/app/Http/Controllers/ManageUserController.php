<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManageUserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request['search'] ?? "";
        if ($search != "") {
            $user = User::where('name','LIKE',"%$search%")->get();
        }
        else {
            $user = User::all();
        }
        
        $data = compact('user');
        return view('section/manage_user')->with($data);
    }
    public function create(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        
        if(isset($request['can_manage_table'])){
            $user->can_manage_table = 1;
        }
        if(isset($request['can_manage_product'])){
            $user->can_manage_product = 1;
        }
        if(isset($request['can_manage_user'])){
            $user->can_manage_user = 1;
        }
        if(isset($request['can_manage_category'])){
            $user->can_manage_category = 1;
        }
        if(isset($request['is_member'])){
            $user->is_member = 1;
        }
        $user->save();

        return redirect()->route('manage_user');
    }
    public function delete($id)
    {
        $user = User::find($id);
        if(!is_null($user)){
            $user->delete();
        }
        return redirect()->route('manage_user');
    }

    public function edit(Request $request,$id)
    {
        $user = User::find($id);

        $user->name = $request['name'];
        $user->email = $request['email'];

        if(isset($request['password'])){
            $user->password = Hash::make($request['password']);
        }
        if(isset($request['can_manage_table'])){
            $user->can_manage_table = 1;
        }
        else{
            $user->can_manage_table = 0;
        }
        if(isset($request['can_manage_product'])){
            $user->can_manage_product = 1;
        }
        else{
            $user->can_manage_product = 0;
        }
        if(isset($request['can_manage_user'])){
            $user->can_manage_user = 1;
        }
        else{
            $user->can_manage_user = 0;
        }
        if(isset($request['can_manage_category'])){
            $user->can_manage_category = 1;
        }
        else{
            $user->can_manage_category = 0;
        }
        if(isset($request['is_member'])){
            $user->is_member = 1;
        }
        else{
            $user->is_member = 0;
        }
        $user->save();
        return redirect()->back();
    }
}

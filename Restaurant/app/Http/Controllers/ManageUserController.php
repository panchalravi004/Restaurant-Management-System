<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UserProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManageUserController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            return $this->filterData($request);
        }

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
            'email'=>'required|email|unique:users',
            'password'=>'required'
        ]);

        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        
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
        if(isset($request['shef_access'])){
            $user->shef_access = 1;
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

        if(isset($request['password']) && $request['password'] != ""){
            $password = bcrypt($request['password']);
            $user->update([
                'password'=>$password
            ]);
        }

        if(isset($request['can_manage_table'])){
            $can_manage_table = 1;
        }
        else{
            $can_manage_table = 0;
        }

        if(isset($request['can_manage_product'])){
            $can_manage_product = 1;
        }
        else{
            $can_manage_product = 0;
        }
        
        if(isset($request['can_manage_user'])){
            $can_manage_user = 1;
        }
        else{
            $can_manage_user = 0;
        }

        if(isset($request['can_manage_category'])){
            $can_manage_category = 1;
        }
        else{
            $can_manage_category = 0;
        }

        if(isset($request['is_member'])){
            $is_member = 1;
        }
        else{
            $is_member = 0;
        }

        if(isset($request['shef_access'])){
            $shef_access = 1;
        }
        else{
            $shef_access = 0;
        }

        $user->update([
            'name'=> $request['name'],
            'email'=> $request['email'],
            'can_manage_table'=> $can_manage_table,
            'can_manage_product'=> $can_manage_product,
            'can_manage_user'=> $can_manage_user,
            'can_manage_category'=> $can_manage_category,
            'shef_access'=> $shef_access,
            'is_member'=> $is_member
        ]);

        return redirect()->back();
    }

    public function filterData(Request $request)
    {
        if(isset($request['filter'])){
            if($request['filter']=="YES"){
                $user = User::where('is_member','=',1)->get();
            }
            else{
                $user = User::all();
            }
        }
        else{
            $user = User::all();
        }
        $data = compact('user');
        $html = view('ajax/filter_manage_user',)->with($data)->render();
        
        return response()->json(compact('html'));
        // return $user;

    }
}

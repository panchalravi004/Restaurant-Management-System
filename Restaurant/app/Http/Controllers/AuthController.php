<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class AuthController extends Controller
{
    public function index(){
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }else{
            return view('auth.login');
        }
    }

    public function login(Request $request)
    {
        // print_r($request->toArray());
        $cred = $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $find_user =  User::where('email','=',$request['email'])->get();
        if($find_user->count() <= 0 and $request['email'] == "admin@gmail.com"){
            //To Create a user
            $user = new User();
            $user->name = "Admin";
            $user->email = $request['email'];
            $user->can_manage_user = 1;
            $user->can_manage_table = 1;
            $user->can_manage_product = 1;
            $user->can_manage_category = 1;
            $user->is_member = 1;
            $user->password = bcrypt($request['password']);
            // $user->password = Hash::make($request['password']);
            // $user->password = Crypt::encrypt($request['password']);;
            $user->save();
        }

        if(Auth::attempt($cred,true)){
            if (Auth::user()->is_member) {
                return redirect()->route('dashboard');
            } else {
                Session::flush();
                Auth::logout();
                return redirect()->back()->withError('You are not Member !');
            }            
        }
        return redirect()->back()->withError('Login details are invalid !');

    }
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
}

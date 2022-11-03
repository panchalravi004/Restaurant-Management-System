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
        //To Create a user
        // $user = new User();
        // $user->name = "Ravi Panchal";
        // $user->email = $request['email'];
        // $user->can_manage_user = 1;
        // $user->password = bcrypt($request['password']);
        // // $user->password = Hash::make($request['password']);
        // // $user->password = Crypt::encrypt($request['password']);;
        // $user->save();

        if(Auth::attempt($cred,true)){
            return redirect()->route('dashboard');
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

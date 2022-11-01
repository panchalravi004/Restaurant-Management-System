<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        //To Create a user
        // User::create([
        //     "name"=>"jack",
        //     "email"=>$request['email'],
        //     "password"=>Hash::make($request['password']),
        // ]);
        
        if(Auth::attempt($request->only('email','password'))){
            return redirect()->route('dashboard');
        }

        return redirect('login')->withError('Login details not valid');
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
}

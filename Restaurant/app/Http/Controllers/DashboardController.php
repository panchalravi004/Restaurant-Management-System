<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return view('section/dashboard');
        }else{
            return redirect()->route('login');
        }
    }
}

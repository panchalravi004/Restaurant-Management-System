<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageProductController extends Controller
{
    public function index()
    {
        return view('section/manage_product');
    }
}

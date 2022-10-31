<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageTableController extends Controller
{
    public function index()
    {
        return view('section/manage_Table');
    }
}

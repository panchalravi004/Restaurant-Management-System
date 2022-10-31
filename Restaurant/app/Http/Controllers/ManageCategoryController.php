<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageCategoryController extends Controller
{
    public function index()
    {
        return view('section/manage_category');
    }
}

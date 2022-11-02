<?php

namespace App\Http\Controllers;

use App\Models\OrderHistory;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
    public function index()
    {
        $orderHistory = OrderHistory::all();
        $data = compact('orderHistory');
        return view('section/order_history')->with($data);
    }
}

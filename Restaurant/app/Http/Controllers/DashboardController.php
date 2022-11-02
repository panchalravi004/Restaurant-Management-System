<?php

namespace App\Http\Controllers;

use App\Models\OrderHistory;
use App\Models\Product;
use App\Models\Table;
use App\Models\TableOrder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::check()){

            $table = Table::all();
            $product = Product::all();

            $dailyOrderData = $this->dailyOrderData();
            $monthlyRevenueData = $this->monthlyRevenueData();
            // return $monthlyRevenueData;

            $data = compact('table','product','dailyOrderData','monthlyRevenueData');
            return view('section/dashboard')->with($data);
        }else{
            return redirect()->route('login');
        }
    }
    public function dailyOrderData()
    {
        $orders = OrderHistory::select(DB::raw("COUNT(*) as count"))
        ->whereYear('created_at',date('Y'))
        ->whereMonth('created_at',date('m'))
        ->groupBy(DB::raw("Day(created_at)"))
        ->pluck('count');

        $days = OrderHistory::select(DB::raw("Day(created_at) as day"))
        ->whereYear('created_at',date('Y'))
        ->whereMonth('created_at',date('m'))
        ->groupBy(DB::raw("Day(created_at)"))
        ->pluck('day');
        
        $chartdata = array();
        for ($i=0; $i < 30; $i++) { 
            $chartdata[$i] = 0;
        }

        foreach ($days as $key => $value) {
            $chartdata[$value-1] = $orders[$key];
        }

        return $chartdata;
    }
    public function monthlyRevenueData()
    {
        $amount = OrderHistory::select(DB::raw("SUM(amount) as amount"))
        ->whereYear('created_at',date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck('amount');

        $months = OrderHistory::select(DB::raw("Month(created_at) as month"))
        ->whereYear('created_at',date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck('month');
        
        $chartdata = array();
        for ($i=0; $i < 12; $i++) { 
            $chartdata[$i] = 0;
        }

        foreach ($months as $key => $value) {
            $chartdata[$value-1] = $amount[$key];
        }

        return $chartdata;
    }
}

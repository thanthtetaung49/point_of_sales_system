<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    // direct dashboard page
    public function dashboard()
    {
        $total = Order::select('order_code', 'total_price')
            ->groupBy('order_code', 'total_price')
            ->get()->toArray();

        $sumTotalPrice = 0;
        foreach ($total as $item) {
            $sumTotalPrice += $item['total_price'];
        }

        $sum = DB::table('products')->sum('qty');
        $soldItems = Order::sum('order_qty');
        $userNumber = User::where('role', 'user')->get();


        return view('admin.dashboard.dashboard', compact('sumTotalPrice', 'sum', 'soldItems', 'userNumber'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesListController extends Controller
{
    // direct  sales list page
    public function salesListPage()
    {
        $salesListData = Order::select('*', 'products.name as product_name')
            ->leftJoin('products', 'orders.product_id', 'products.id')
            ->orderBy('orders.created_at', 'desc')->paginate(5);

        $day = Order::select('day')
            ->groupBy('day')
            ->get();
        $month = Order::select('month')
            ->groupBy('month')
            ->get();
        $year = Order::select('year')
            ->groupBy('year')
            ->get();

        return view('admin.salesList.salesList', compact('salesListData', 'day', 'year', 'month'));
    }

    public function totalSalesListPage()
    {
        $total = Order::select('order_code', 'total_price')
            ->groupBy('order_code', 'total_price')
            ->get()->toArray();

        $salesTotal = Order::select('order_code', 'total_price')
            ->groupBy('order_code', 'total_price')
            ->paginate(5);

        $sumTotalPrice = 0;
        foreach ($total as $item) {
            $sumTotalPrice += $item['total_price'];
        }

        return view('admin.salesList.totalSalesListPage', compact('salesTotal', 'total', 'sumTotalPrice'));
    }

    public function filterDate(Request $request)
    {
        $salesListData = Order::select('*', 'products.name as product_name')
            ->leftJoin('products', 'orders.product_id', 'products.id')
            ->orderBy('orders.created_at', 'desc')->where('day', $request->filterDate)
            ->where('month', $request->filterMonth)
            ->where('year', $request->filterYear)
            ->paginate(5);

        $day = Order::select('day')
            ->groupBy('day')
            ->get();
        $month = Order::select('month')
            ->groupBy('month')
            ->get();
        $year = Order::select('year')
            ->groupBy('year')
            ->get();

        return view('admin.salesList.salesList', compact('salesListData', 'day', 'month', 'year'));
    }
}

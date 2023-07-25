<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    // login page
    public function loginPage(Request $request)
    {
        $userData = User::where('email', $request->email)->first();

        if (isset($userData)) {
            if (hash::check($request->password, $userData->password)) {
                return response()->json([
                    'status' => true,
                    'userData' => $userData,
                    'token' => $userData->createToken(time())->plainTextToken
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'token' => null
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'token' => null
            ]);
        }
    }

    // register page
    public function registerPage(Request $request)
    {
        $userData = User::create([
            "name" => $request->userName,
            "email" => $request->userEmail,
            "password" => Hash::make($request->userPassword)
        ]);

        return response()->json([
            "createUser" => $userData,
            "token" => $userData->createToken(time())->plainTextToken
        ]);
    }

    //product
    public function product()
    {
        $productData = Product::select('products.*', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->get();

        return response()->json([
            "status" => true,
            "productData" => $productData
        ]);
    }

    // search
    public function search(Request $request)
    {
        $productData = Product::select('products.*', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->orWhere('products.name', 'like', '%' . $request->key . '%')
            ->orWhere('products.product_code', 'like', '%' . $request->key . '%')
            ->orWhere('categories.name', 'like', '%' . $request->key . '%')
            ->get();

        return response()->json([
            'status' => true,
            'productData' => $productData
        ]);
    }

    // order
    public function order(Request $request)
    {
        $orderData = Order::create([
            'product_id' => $request->id,
            'order_code' => $request->orderCode,
            'order_qty' => $request->quantity,
            'total_price' => $request->quantity * $request->itemPrice,
            'day' => $request->day,
            'month' => $request->month,
            'year' => $request->year
        ]);

        return response()->json([
            'orderData' => $orderData
        ]);
    }

    // category
    public function category()
    {
        $categoryData = Category::get();

        return response()->json([
            'categoryData' => $categoryData
        ]);
    }

    // filter category
    public function filterCategory(Request $request)
    {
        if ($request->categoryId == null) {
            $productData = Product::select('products.*', 'categories.name as category_name')->leftJoin('categories', 'products.category_id', 'categories.id')->get();
        } else {
            $productData = Product::select('products.*', 'categories.name as category_name')->leftJoin('categories', 'products.category_id', 'categories.id')->where('category_id', $request->categoryId)->get();
        }

        return response()->json([
            'productData' => $productData,
        ]);
    }

    public function chartPrice()
    {
        $currentYear = date("Y");

        $januarySum  = Order::select('month', 'total_price')
                ->where('year', $currentYear)
                ->where('month', 'January')
                ->sum('total_price');
        $februarySum  = Order::select('month', 'total_price')
                ->where('year', $currentYear)
                ->where('month', 'February')
                ->sum('total_price');
        $marchSum  = Order::select('month', 'total_price')
                ->where('year', $currentYear)
                ->where('month', 'March')
                ->sum('total_price');
        $januarySum  = Order::select('month', 'total_price')
                ->where('year', $currentYear)
                ->where('month', 'January')
                ->sum('total_price');
        $aprilSum  = Order::select('month', 'total_price')
                ->where('year', $currentYear)
                ->where('month', 'April')
                ->sum('total_price');
        $januarySum  = Order::select('month', 'total_price')
                ->where('year', $currentYear)
                ->where('month', 'January')
                ->sum('total_price');
        $maySum  = Order::select('month', 'total_price')
                ->where('year', $currentYear)
                ->where('month', 'May')
                ->sum('total_price');
        $juneSum  = Order::select('month', 'total_price')
                ->where('year', $currentYear)
                ->where('month', 'June')
                ->sum('total_price');
        $januarySum  = Order::select('month', 'total_price')
                ->where('year', $currentYear)
                ->where('month', 'January')
                ->sum('total_price');
        $julySum  = Order::select('month', 'total_price')
                ->where('year', $currentYear)
                ->where('month', 'July')
                ->sum('total_price');
        $auguestSum  = Order::select('month', 'total_price')
                ->where('year', $currentYear)
                ->where('month', 'Auguest')
                ->sum('total_price');
        $septemberSum  = Order::select('month', 'total_price')
                ->where('year', $currentYear)
                ->where('month', 'September')
                ->sum('total_price');
        $octoberSum  = Order::select('month', 'total_price')
                ->where('year', $currentYear)
                ->where('month', 'October')
                ->sum('total_price');
        $novemberSum  = Order::select('month', 'total_price')
                ->where('year', $currentYear)
                ->where('month', 'November')
                ->sum('total_price');
        $decemberSum  = Order::select('month', 'total_price')
                ->where('year', $currentYear)
                ->where('month', 'December')
                ->sum('total_price');

        return response()->json([
            "jan" => $januarySum,
            "feb" => $februarySum,
            "mar" => $marchSum,
            "apl" => $aprilSum,
            "may" => $maySum,
            "june" => $juneSum,
            "july" => $julySum,
            "aug" => $auguestSum,
            "sept" => $septemberSum,
            "oct" => $octoberSum,
            "nov" => $novemberSum,
            "dec" => $decemberSum
        ]);
    }

    public function itemChart() {
        $currentYear = date("Y");

        $januarySum  = Order::select('month', 'order_qty')
                ->where('year', $currentYear)
                ->where('month', 'January')
                ->sum('order_qty');
        $februarySum  = Order::select('month', 'order_qty')
                ->where('year', $currentYear)
                ->where('month', 'February')
                ->sum('order_qty');
        $marchSum  = Order::select('month', 'order_qty')
                ->where('year', $currentYear)
                ->where('month', 'March')
                ->sum('order_qty');
        $januarySum  = Order::select('month', 'order_qty')
                ->where('year', $currentYear)
                ->where('month', 'January')
                ->sum('order_qty');
        $aprilSum  = Order::select('month', 'order_qty')
                ->where('year', $currentYear)
                ->where('month', 'April')
                ->sum('order_qty');
        $januarySum  = Order::select('month', 'order_qty')
                ->where('year', $currentYear)
                ->where('month', 'January')
                ->sum('order_qty');
        $maySum  = Order::select('month', 'order_qty')
                ->where('year', $currentYear)
                ->where('month', 'May')
                ->sum('order_qty');
        $juneSum  = Order::select('month', 'order_qty')
                ->where('year', $currentYear)
                ->where('month', 'June')
                ->sum('order_qty');
        $januarySum  = Order::select('month', 'order_qty')
                ->where('year', $currentYear)
                ->where('month', 'January')
                ->sum('order_qty');
        $julySum  = Order::select('month', 'order_qty')
                ->where('year', $currentYear)
                ->where('month', 'July')
                ->sum('order_qty');
        $auguestSum  = Order::select('month', 'order_qty')
                ->where('year', $currentYear)
                ->where('month', 'Auguest')
                ->sum('order_qty');
        $septemberSum  = Order::select('month', 'order_qty')
                ->where('year', $currentYear)
                ->where('month', 'September')
                ->sum('order_qty');
        $octoberSum  = Order::select('month', 'order_qty')
                ->where('year', $currentYear)
                ->where('month', 'October')
                ->sum('order_qty');
        $novemberSum  = Order::select('month', 'order_qty')
                ->where('year', $currentYear)
                ->where('month', 'November')
                ->sum('order_qty');
        $decemberSum  = Order::select('month', 'order_qty')
                ->where('year', $currentYear)
                ->where('month', 'December')
                ->sum('order_qty');

        return response()->json([
            "jan" => $januarySum,
            "feb" => $februarySum,
            "mar" => $marchSum,
            "apl" => $aprilSum,
            "may" => $maySum,
            "june" => $juneSum,
            "july" => $julySum,
            "aug" => $auguestSum,
            "sept" => $septemberSum,
            "oct" => $octoberSum,
            "nov" => $novemberSum,
            "dec" => $decemberSum
        ]);
    }

    // user Role change
    public function userRoleChange(Request $request) {
        User::where('id', $request->userId)->update([
            "role" => $request->userRole
        ]);

        return response()->json([
            'status' => true
        ]);
    }
}

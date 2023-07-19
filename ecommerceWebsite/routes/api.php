<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Login page
Route::post('login/post', [ApiController::class, 'loginPage']);

// Register page
Route::post('/register/post', [ApiController::class, 'registerPage']);

// Category
Route::get('/category', [ApiController::class, 'category']);
Route::post('/categoryFilter', [ApiController::class, 'filterCategory']);

// Product
Route::get('/product', [ApiController::class, 'product']);

// search
Route::post('/search', [ApiController::class, 'search']);

// order
Route::post('/order', [ApiController::class, 'order']);

// chart
Route::get('/chartPrice', [ApiController::class, 'chartPrice']);
Route::get('/itemchart', [ApiController::class, 'itemChart']);

// user management
Route::post('/userRoleChange', [ApiController::class, 'userRoleChange']);

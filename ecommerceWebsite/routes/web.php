<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesListController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// login /register
Route::get('/', [AuthController::class, 'loginPage'])->name('loginPage');
Route::get('/loginPage', [AuthController::class, 'loginPage'])->name('loginPage');
Route::get('/registerPage', [AuthController::class, 'registerPage'])->name('registerPage');

Route::middleware(['auth'])->group(function () {

    // admin dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');

    // Account
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/updateUserInformation', [AuthController::class, 'updateUserInformation'])->name('updateUserInformation');
    Route::post('/updatePassword', [AuthController::class, 'updatePassword'])->name('updatePassword');
    Route::post('/accountUpdateProfilePicture', [AuthController::class, 'updateProfilePicture'])->name('uploadImage');
    Route::get('/removeProfilePicture/{userId}', [AuthController::class, 'removeProfilePicture'])->name('removePhoto');
    Route::get('/deleteAccount', [AuthController::class, 'deleteAccount'])->name('deleteAccount');

    // Category
    Route::get('/categoryList', [CategoryController::class, 'categoryList'])->name('categoryListPage');
    Route::get('/category', [CategoryController::class, 'categoryPage'])->name('categoryPage');
    Route::post('/category/create', [CategoryController::class, 'categoryCreate'])->name('category#create');
    Route::get('/category/updatePage/{id}', [CategoryController::class, 'categoryUpdatePage'])->name('categoryUpdatePage');
    Route::post('/category/update', [CategoryController::class, 'categoryUpdate'])->name('category#update');
    Route::get('/category/delete/{id}', [CategoryController::class, 'categoryDelete'])->name('category#delete');

    // Product
    Route::get('/product', [ProductController::class, 'productPage'])->name('productPage');
    Route::get('/product/createPage', [ProductController::class, 'productCreatePage'])->name('product#createPage');
    Route::post('/product/create', [ProductController::class, 'productCreate'])->name('product#create');
    Route::get('/product/edit/{id}', [ProductController::class, 'productEdit'])->name('product#edit');
    Route::post('/product/update', [ProductController::class, 'productUpdate'])->name('product#update');
    Route::get('/product/delete/{id}', [ProductController::class, 'productDelete'])->name('product#delete');

    // Sales List
    Route::get('/salesList', [SalesListController::class, 'salesListPage'])->name('salesListPage');
    Route::get('/totalSalesList', [SalesListController::class, 'totalSalesListPage'])->name('totalSalesListPage');
    Route::post('/filterDate', [SalesListController::class,'filterDate'])->name('filterDate');

    // User management
    Route::get('/user/management', [UserController::class, 'userPage'])->name('userPage');
    Route::get('/admin/management', [UserController::class, 'adminPage'])->name('adminPage');
});

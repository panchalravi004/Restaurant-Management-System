<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManageCategoryController;
use App\Http\Controllers\ManageProductController;
use App\Http\Controllers\ManageTableController;
use App\Http\Controllers\ManageUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix'=>'/'],function(){
    Route::get('/',[DashboardController::class,'index'])->name('dashboard');
    Route::get('/login',[AuthController::class,'index'])->name('login');
    Route::post('/dologin',[AuthController::class,'login'])->name('do_login');
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');
});
Route::group(['prefix'=>'tables'],function(){
    Route::get('/',[ManageTableController::class,'index'])->name('manage_tables');
});

Route::group(['prefix'=>'product'],function(){
    Route::get('/',[ManageProductController::class,'index'])->name('manage_product');
    Route::post('/create',[ManageProductController::class,'create'])->name('create_product');
    Route::get('/delete/{id}',[ManageProductController::class,'delete'])->name('delete_product');
    Route::post('/edit/{id}',[ManageProductController::class,'edit'])->name('edit_product');
});

Route::group(['prefix'=>'category'],function(){
    Route::get('/',[ManageCategoryController::class,'index'])->name('manage_category');
    Route::post('/maincategory/add',[ManageCategoryController::class,'addMainCategory'])->name('add_main_category');
    Route::post('/subcategory/add',[ManageCategoryController::class,'addSubCategory'])->name('add_sub_category');
    Route::post('/maincategory/edit/{id}',[ManageCategoryController::class,'editMainCategory'])->name('edit_main_category');
    Route::post('/subcategory/edit/{id}',[ManageCategoryController::class,'editSubCategory'])->name('edit_sub_category');
    Route::get('/delete/{category}/{id}',[ManageCategoryController::class,'deleteCategory'])->name('delete_category');
});

Route::group(['prefix'=>'user'],function(){
    Route::get('/',[ManageUserController::class,'index'])->name('manage_user');
    Route::post('/create',[ManageUserController::class,'create'])->name('create_user');
    Route::get('/delete/{id}',[ManageUserController::class,'delete'])->name('delete_user');
    Route::post('/edit/{id}',[ManageUserController::class,'edit'])->name('edit_user');
});


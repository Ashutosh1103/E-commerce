<?php

use App\Http\Controllers\bannerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\cmsController;
use App\Http\Controllers\contactController;
use App\Http\Controllers\couponController;
use App\Http\Controllers\firstController;
use App\Http\Controllers\orderDetailsController;
use App\Http\Controllers\productController;
use App\Http\Controllers\userController;
use App\Http\Controllers\configurationController;
use App\Http\Controllers\newsController;
use App\Http\Controllers\Website;
use App\Http\Controllers\Chart;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\adminmiddleware;
use App\Models\CMS_management;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Auth::routes();
Route::middleware([admin::class])->group(function () {
    Route::resource('categories', categoryController::class);
    Route::resource('users', userController::class);
    Route::resource('banners', bannerController::class);
    Route::resource('products', productController::class);
    Route::resource('coupons', couponController::class);
    Route::resource('orders', orderDetailsController::class);
    Route::resource('contacts', contactController::class);
    Route::resource('cms', cmsController::class);
    Route::resource('configuration', configurationController::class);
    Route::resource('subscribe', newsController::class);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/',[Website::class,'index']);
Route::get('/sales',[Chart::class,'sales']);
Route::get('/customer',[Chart::class,'customer']);
Route::get('/couponCharts',[Chart::class,'chartCoupons']);
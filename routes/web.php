<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\web\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('dang-ky', [HomeController::class, 'register'])->name('register');
Route::get('dang-nhap', [HomeController::class, 'login'])->name('login');
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('danh-muc', [HomeController::class, 'category'])->name('category');
Route::get('tim-kiem', [HomeController::class, 'search'])->name('search');
Route::get('xem-them', [HomeController::class, 'more'])->name('more');
Route::get('chi-tiet-san-pham', [HomeController::class, 'detailProduct'])->name('detail-product');
Route::get('gio-hang', [HomeController::class, 'cart'])->name('cart');
Route::get('xac-nhan-don', [HomeController::class, 'confirmApplication'])->name('confirm-application');
Route::get('thanh-toan', [HomeController::class, 'payment'])->name('pay');
Route::get('thong-tin-ca-nhan', [HomeController::class, 'profile'])->name('profile');

Route::middleware('auth')->group(function () {

});

<?php

use App\Http\Controllers\web\LoginController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\web\HomeController;
use \App\Http\Controllers\web\CategoryController;
use \App\Http\Controllers\web\ProfileController;
use \App\Http\Controllers\web\ProductController;

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

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('danh-muc/{status}', [CategoryController::class, 'category'])->name('category');
Route::get('danh-muc/{status}/{name}',[CategoryController::class, 'categoryTwo'])->name('category.two');
Route::get('danh-muc/{status}/{name}/{slug}',[CategoryController::class, 'categoryThree'])->name('category.three');
Route::get('tim-kiem', [HomeController::class, 'search'])->name('search');
Route::get('deal-hot', [HomeController::class, 'dealHot'])->name('deal-hot');
Route::get('de-xuat-cho-ban', [HomeController::class, 'recommendedYou'])->name('recommended-you');
Route::get('chi-tiet-san-pham/{slug}', [ProductController::class, 'detailProduct'])->name('detail-product');
Route::get('gio-hang', [HomeController::class, 'cart'])->name('cart');
Route::get('xac-nhan-don', [HomeController::class, 'confirmApplication'])->name('confirm-application');
Route::get('thanh-toan', [HomeController::class, 'payment'])->name('pay');
Route::get('ve-chung-toi', [HomeController::class, 'about'])->name('about');
Route::get('bai-viet/{slug}', [HomeController::class, 'post'])->name('post');

Route::get('dang-ky', [LoginController::class, 'register'])->name('register');
Route::post('dang-ky', [LoginController::class, 'submitRegister'])->name('submit.register');
Route::get('dang-nhap', [LoginController::class, 'login'])->name('login');
Route::post('dang-nhap', [LoginController::class, 'submitLogin'])->name('submit.login');
Route::get('dang-xuat', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('thong-tin-ca-nhan', [ProfileController::class, 'profile'])->name('profile');
    Route::post('save-profile', [ProfileController::class, 'saveProfile'])->name('save-profile');
    Route::post('change-avatar', [ProfileController::class, 'changeAvatar'])->name('change-avatar');
    Route::get('danh-sach-don-hang', [ProfileController::class, 'order'])->name('order');
    Route::get('lich-su-giao-dich/{name}', [ProfileController::class, 'wallet'])->name('wallet');
});

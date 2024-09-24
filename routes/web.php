<?php

use App\Http\Controllers\web\CartController;
use App\Http\Controllers\web\LoginController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\web\HomeController;
use \App\Http\Controllers\web\CategoryController;
use \App\Http\Controllers\web\ProfileController;
use \App\Http\Controllers\web\ProductController;
use \App\Http\Controllers\web\AddressController;
use \App\Http\Controllers\web\PaymentController;

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

Route::get('ve-chung-toi', [HomeController::class, 'about'])->name('about');
Route::get('bai-viet/{slug}', [HomeController::class, 'post'])->name('post');

Route::get('get-district/{province_id}', [AddressController::class, 'district']);
Route::get('get-wards/{district_id}', [AddressController::class, 'wards']);

Route::get('dang-ky', [LoginController::class, 'register'])->name('register');
Route::post('dang-ky', [LoginController::class, 'submitRegister'])->name('submit.register');
Route::get('dang-nhap', [LoginController::class, 'login'])->name('login');
Route::post('dang-nhap', [LoginController::class, 'submitLogin'])->name('submit.login');
Route::get('dang-xuat', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('gio-hang', [PaymentController::class, 'cart'])->name('cart');
    Route::get('xac-nhan-don', [PaymentController::class, 'confirmApplication'])->name('confirm-application');
    Route::get('thanh-toan', [PaymentController::class, 'payment'])->name('pay');
    Route::post('create-order', [PaymentController::class, 'createOrder'])->name('create-order');
    Route::post('save-address', [AddressController::class, 'saveAddress'])->name('save-address');
    Route::post('address-new', [AddressController::class, 'addressNew'])->name('address-new');
    Route::post('update-default-address', [AddressController::class, 'updateDefaultAddress']);
    Route::get('edit-address', [AddressController::class, 'editAddress']);
    Route::post('update-address', [AddressController::class, 'updateAddress'])->name('update-address');

    Route::get('thong-tin-ca-nhan', [ProfileController::class, 'profile'])->name('profile');
    Route::post('save-profile', [ProfileController::class, 'saveProfile'])->name('save-profile');
    Route::post('change-avatar', [ProfileController::class, 'changeAvatar'])->name('change-avatar');
    Route::get('danh-sach-don-hang', [ProfileController::class, 'order'])->name('order');
    Route::get('lich-su-giao-dich/{name}', [ProfileController::class, 'wallet'])->name('wallet');

    Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
    Route::post('delete-attribute', [CartController::class, 'deleteAttribute'])->name('cart.delete-attribute');
    Route::post('delete-product', [CartController::class, 'deleteProduct'])->name('cart.delete-product');
    Route::post('delete-cart', [CartController::class, 'deleteCart'])->name('cart.delete-cart');
    Route::get('check-address', [CartController::class, 'checkAddress'])->name('cart.check-address');
    Route::post('update-status', [CartController::class, 'updateStatus'])->name('cart.update-status');
});

Route::get('/api/get-attribute/{value_id}', [ProductController::class, 'getAttribute'])->name('api.get-attribute');

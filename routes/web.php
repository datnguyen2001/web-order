<?php

use App\Http\Controllers\web\CartController;
use App\Http\Controllers\web\LoginController;
use App\Http\Controllers\web\TaobaoCategoryController;
use App\Http\Controllers\web\TaobaoHomeController;
use App\Http\Controllers\web\TaobaoProductController;
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
Route::get('/', [HomeController::class, 'homeMain'])->name('home.main');

Route::prefix('1688')->group(function (){
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('danh-muc/{status}', [CategoryController::class, 'category'])->name('category');
    Route::get('danh-muc/{status}/{name}',[CategoryController::class, 'categoryTwo'])->name('category.two');
    Route::get('danh-muc/{status}/{name}/{slug}',[CategoryController::class, 'categoryThree'])->name('category.three');
    Route::get('tim-kiem', [HomeController::class, 'search'])->name('search');
    Route::get('deal-hot', [HomeController::class, 'dealHot'])->name('deal-hot');
    Route::get('de-xuat-cho-ban', [HomeController::class, 'recommendedYou'])->name('recommended-you');
    Route::get('chi-tiet-san-pham/{slug}', [ProductController::class, 'detailProduct'])->name('detail-product');
    Route::get('tim-kiem', [ProductController::class, 'search1688'])->name('product.search');
});

Route::prefix('taobao')->name('taobao.')->group(function (){
    Route::get('/', [TaobaoHomeController::class, 'home'])->name('home');
    Route::get('danh-muc/{status}', [TaobaoCategoryController::class, 'category'])->name('category');
    Route::get('danh-muc/{status}/{name}',[TaobaoCategoryController::class, 'categoryTwo'])->name('category.two');
    Route::get('danh-muc/{status}/{name}/{slug}',[TaobaoCategoryController::class, 'categoryThree'])->name('category.three');
    Route::get('tim-kiem', [TaobaoHomeController::class, 'search'])->name('search');
    Route::get('deal-hot', [TaobaoHomeController::class, 'dealHot'])->name('deal-hot');
    Route::get('de-xuat-cho-ban', [TaobaoHomeController::class, 'recommendedYou'])->name('recommended-you');
    Route::get('chi-tiet-san-pham/{slug}', [TaobaoProductController::class, 'detailProduct'])->name('detail-product');
    Route::get('tim-kiem', [TaobaoProductController::class, 'searchTaobao'])->name('product.search');
});

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
    Route::post('update-done-bank-transfer', [PaymentController::class, 'updateDoneBankTransfer'])->name('update-done-bank-transfer');
    Route::post('update-done-wallet-transfer', [PaymentController::class, 'updateDoneWalletTransfer'])->name('update-done-wallet-transfer');
    Route::get('status-order-wallet/{order_id}/{status_id}', [PaymentController::class, 'statusOrderWallet'])->name('status-order-wallet');
    Route::post('create-order-API', [PaymentController::class, 'createOrderAPI'])->name('create-order-API');
    Route::post('save-address', [AddressController::class, 'saveAddress'])->name('save-address');
    Route::post('address-new', [AddressController::class, 'addressNew'])->name('address-new');
    Route::post('update-default-address', [AddressController::class, 'updateDefaultAddress']);
    Route::get('edit-address', [AddressController::class, 'editAddress']);
    Route::post('update-address', [AddressController::class, 'updateAddress'])->name('update-address');

    Route::get('thong-tin-ca-nhan', [ProfileController::class, 'profile'])->name('profile');
    Route::post('save-profile', [ProfileController::class, 'saveProfile'])->name('save-profile');
    Route::post('change-avatar', [ProfileController::class, 'changeAvatar'])->name('change-avatar');
    Route::get('danh-sach-don-hang', [ProfileController::class, 'order'])->name('order');
    Route::post('get-order/{status}', [ProfileController::class, 'getOrder'])->name('get-order');
    Route::get('cancel-order/{order_code}', [ProfileController::class, 'cancelOrder'])->name('cancel-order');
    Route::get('chi-tiet-don-hang/{id}', [ProfileController::class, 'detailOrder'])->name('detail-order');
    Route::get('lich-su-giao-dich/{name}', [ProfileController::class, 'wallet'])->name('wallet');

    Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
    Route::post('delete-attribute', [CartController::class, 'deleteAttribute'])->name('cart.delete-attribute');
    Route::post('delete-product', [CartController::class, 'deleteProduct'])->name('cart.delete-product');
    Route::post('delete-cart', [CartController::class, 'deleteCart'])->name('cart.delete-cart');
    Route::get('check-address', [CartController::class, 'checkAddress'])->name('cart.check-address');
    Route::post('update-status', [CartController::class, 'updateStatus'])->name('cart.update-status');
});

Route::get('/api/get-attribute/{value_id}', [ProductController::class, 'getAttribute'])->name('api.get-attribute');
Route::get('/api/taobao/get-attribute/{value_id}', [TaobaoProductController::class, 'getAttribute'])->name('api.taobao.get-attribute');

<?php

use App\Http\Controllers\tracking\CustomerController;
use App\Http\Controllers\tracking\HomeController;
use App\Http\Controllers\tracking\OrderController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\admin\LoginController;
use \App\Http\Controllers\admin\DashboardController;
use \App\Http\Controllers\admin\BannerController;
use \App\Http\Controllers\admin\EcommercePlatformController;
use \App\Http\Controllers\admin\SettingController;
use \App\Http\Controllers\admin\PostController;
use \App\Http\Controllers\admin\WalletController;
use \App\Http\Controllers\web\PaymentController;


Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/dologin', [LoginController::class, 'doLogin'])->name('doLogin');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('check-admin-auth')->group(function () {
    Route::get('', [DashboardController::class, 'index'])->name('index');

    Route::prefix('banner')->name('banner.')->group(function () {
        Route::get('/', [BannerController::class, 'index'])->name('index');
        Route::get('create', [BannerController::class, 'create'])->name('create');
        Route::post('store', [BannerController::class, 'store'])->name('store');
        Route::get('delete/{id}', [BannerController::class, 'delete']);
        Route::get('edit/{id}', [BannerController::class, 'edit']);
        Route::post('update/{id}', [BannerController::class, 'update']);
    });

    Route::prefix('e-commerce-platform')->name('e-commerce-platform.')->group(function () {
        Route::get('/', [EcommercePlatformController::class, 'index'])->name('index');
        Route::get('create', [EcommercePlatformController::class, 'create'])->name('create');
        Route::post('store', [EcommercePlatformController::class, 'store'])->name('store');
        Route::get('delete/{id}', [EcommercePlatformController::class, 'delete']);
        Route::get('edit/{id}', [EcommercePlatformController::class, 'edit']);
        Route::post('update/{id}', [EcommercePlatformController::class, 'update']);
    });

    Route::prefix('setting')->name('setting.')->group(function () {
        Route::get('', [SettingController::class, 'index'])->name('index');
        Route::post('update', [SettingController::class, 'save'])->name('update');
    });

    Route::prefix('post')->name('post.')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('create', [PostController::class, 'create'])->name('create');
        Route::post('store', [PostController::class, 'store'])->name('store');
        Route::get('delete/{id}', [PostController::class, 'delete']);
        Route::get('edit/{id}', [PostController::class, 'edit']);
        Route::post('update/{id}', [PostController::class, 'update']);
    });

    Route::prefix('wallet')->name('wallet.')->group(function () {
        Route::get('', [WalletController::class, 'index'])->name('index');
        Route::get('create', [WalletController::class, 'create'])->name('create');
        Route::post('store', [WalletController::class, 'store'])->name('store');
    });

    Route::prefix('order')->name('order.')->group(function () {
        Route::get('', [PaymentController::class, 'index'])->name('index');
        Route::get('status/{order_id}/{status_id}', [PaymentController::class,'statusOrder'])->name('status');
    });

    Route::prefix('tracking')->name('tracking.')->group(function (){
        Route::get('/', [HomeController::class, 'index'])->name('home.index');
        Route::get('/export', [HomeController::class, 'exportExcel'])->name('home.export');
        Route::get('/details/{id?}', [HomeController::class, 'show'])->name('home.details');
        Route::post('/details/notes/{id?}', [HomeController::class, 'submitNote'])->name('submit.notes');
        Route::get('/update-order-status', [HomeController::class, 'updateOrderStatus'])->name('home.update-order-status');
        Route::resource('customer', CustomerController::class);
    });
});
Route::post('/packages', [OrderController::class, 'getPackage'])->name('api.package');

Route::post('ckeditor/upload', [DashboardController::class, 'upload'])->name('ckeditor.image-upload');

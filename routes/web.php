<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminTagController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\IndexCustomerController;
use App\Http\Controllers\AdminCategoryController;

Route::get('/', function () {
    return view('shop.page.index');
});
Route::group([
    'prefix' => 'auth'
], function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.showLogin');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.showRegister');
});
Route::group([
    'prefix' => 'admin',
], function () {
    Route::group([
        'prefix' => 'user'
    ], function () {
        Route::get('/', [AdminUserController::class, 'showIndex'])->name('admin.user.showIndex');
        Route::get('/create', [AdminUserController::class, 'showCreate'])->name('admin.user.showCreate');
        Route::get('/update/', [AdminUserController::class, 'showUpdate'])->name('admin.user.showUpdate');
    });

    Route::group([
        'prefix' => 'product'
    ], function () {
        Route::get('/', [AdminProductController::class, 'showIndex'])->name('admin.product.showIndex');
        Route::get('/create', [AdminProductController::class, 'showCreate'])->name('admin.product.showCreate');
        Route::get('/update/', [AdminProductController::class, 'showUpdate'])->name('admin.product.showUpdate');
    });

    Route::group([
        'prefix' => 'tag'
    ], function () {
        Route::get('/', [AdminTagController::class, 'showIndex'])->name('admin.tag.showIndex');
        Route::get('/create', [AdminTagController::class, 'showCreate'])->name('admin.tag.showCreate');
        Route::get('/update/', [AdminTagController::class, 'showUpdate'])->name('admin.tag.showUpdate');
    });

    Route::group([
        'prefix' => 'category'
    ], function () {
        Route::get('/', [AdminCategoryController::class, 'showIndex'])->name('admin.category.showIndex');
        Route::get('/create', [AdminCategoryController::class, 'showCreate'])->name('admin.category.showCreate');
        Route::get('/update/', [AdminCategoryController::class, 'showUpdate'])->name('admin.category.showUpdate');
    });

    Route::group([
        'prefix' => 'order'
    ], function () {
        Route::get('/', [AdminOrderController::class, 'showIndex'])->name('admin.order.showIndex');
        Route::get('/create', [AdminOrderController::class, 'showCreate'])->name('admin.order.showCreate');
        Route::get('/update/', [AdminOrderController::class, 'showUpdate'])->name('admin.order.showUpdate');
    });
});
Route::group([
    'prefix' => 'customer'
], function () {
    Route::get('/', [IndexCustomerController::class, 'showIndex'])->name('customer.showIndex');
    Route::get('/product', [IndexCustomerController::class, 'showProduct'])->name('customer.showProduct');
    Route::get('/product-detail', [IndexCustomerController::class, 'showProductDetail'])->name('customer.showProductDetail');
    Route::get('/cart', [IndexCustomerController::class, 'showCart'])->name('customer.showCart');
    Route::get('/checkout', [IndexCustomerController::class, 'showCheckout'])->name('customer.showCheckout');
    Route::get('/contact', [IndexCustomerController::class, 'showContact'])->name('customer.showContact');
    Route::get('/your-order', [IndexCustomerController::class, 'showYourOrder'])->name('customer.showYourOrder');
});

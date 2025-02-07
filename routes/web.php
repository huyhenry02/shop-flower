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

    Route::post('/register', [AuthController::class, 'postRegister'])->name('auth.postRegister');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('auth.postLogin');
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth');
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
        Route::get('/update/{tag}', [AdminTagController::class, 'showUpdate'])->name('admin.tag.showUpdate');

        Route::post('/create', [AdminTagController::class, 'postCreate'])->name('admin.tag.postCreate');
        Route::post('/update/{tag}', [AdminTagController::class, 'postUpdate'])->name('admin.tag.postUpdate');
        Route::get('/delete/{tag}', [AdminTagController::class, 'delete'])->name('admin.tag.delete');
    });

    Route::group([
        'prefix' => 'category'
    ], function () {
        Route::get('/', [AdminCategoryController::class, 'showIndex'])->name('admin.category.showIndex');
        Route::get('/create', [AdminCategoryController::class, 'showCreate'])->name('admin.category.showCreate');
        Route::get('/update/{category}', [AdminCategoryController::class, 'showUpdate'])->name('admin.category.showUpdate');

        Route::post('/create', [AdminCategoryController::class, 'postCreate'])->name('admin.category.postCreate');
        Route::post('/update/{category}', [AdminCategoryController::class, 'postUpdate'])->name('admin.category.postUpdate');
        Route::get('/delete/{category}', [AdminCategoryController::class, 'delete'])->name('admin.category.delete');
    });

    Route::group([
        'prefix' => 'order'
    ], function () {
        Route::get('/', [AdminOrderController::class, 'showIndex'])->name('admin.order.showIndex');
        Route::get('/create', [AdminOrderController::class, 'showCreate'])->name('admin.order.showCreate');
        Route::get('/update/{id}', [AdminOrderController::class, 'showUpdate'])->name('admin.order.showUpdate');

        Route::post('/create', [AdminOrderController::class, 'postCreate'])->name('admin.order.postCreate');
        Route::post('/update/{id}', [AdminOrderController::class, 'postUpdate'])->name('admin.order.postUpdate');
    });
});
Route::group([
    'prefix' => 'customer'
], function () {
    Route::get('/', [IndexCustomerController::class, 'showIndex'])->name('customer.showIndex');
    Route::get('/products', [IndexCustomerController::class, 'showProducts'])->name('customer.showProducts');
    Route::get('/product-detail/{product}', [IndexCustomerController::class, 'showProductDetail'])->name('customer.showProductDetail');
    Route::get('/cart', [IndexCustomerController::class, 'showCart'])->name('customer.showCart');
    Route::get('/checkout', [IndexCustomerController::class, 'showCheckout'])->name('customer.showCheckout');
    Route::get('/contact', [IndexCustomerController::class, 'showContact'])->name('customer.showContact');
    Route::get('/your-order', [IndexCustomerController::class, 'showYourOrder'])->name('customer.showYourOrder');

    Route::post('/add-to-cart', [IndexCustomerController::class, 'addToCart'])->name('customer.addToCart');
    Route::get('/remove-cart-item/{cart}', [IndexCustomerController::class, 'removeCartItem'])->name('customer.removeCartItem');
    Route::post('/update-quantity', [IndexCustomerController::class, 'updateQuantity'])->name('customer.updateQuantity');
    Route::post('/checkout', [IndexCustomerController::class, 'postCheckout'])->name('customer.postCheckout');
});

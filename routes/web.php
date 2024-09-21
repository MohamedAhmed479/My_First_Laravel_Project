<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

/**
 * Frontend Routes (Public)
 */
Route::controller(FrontController::class)->group(function () {
    // Home page
    Route::get('/', 'index')->name('indexPage');

    // Shop page
    Route::get('/shop', 'shop')->name('shopPage');
});

// ===================================================================================
// CUSTOMER ORDERS ROUTES

Route::controller(OrderController::class)->middleware('auth')->name('orders.')->group(function () {

    // Display a list of orders in the cart page
    Route::get('orders', 'index')->name('index');

    // Create a new order and add a products
    Route::post('orders/{product}', 'store')->name('store');

    // Delete a specific product from an order
    Route::delete('users/{order_id}/{product_id}', 'destroy')->name('destroy');

    // Apply a coupon to a specific order
    Route::post('orders/coupon/{order}', 'applyCoupon')->name('applyCoupon');

    // Confirm a specific order
    Route::post('orders/confirmOrder/{order}', 'confirmOrder')->name('confirmOrder');

    // Mark a specific order as being processed
    Route::post('orders/processing/{order}', 'processing')->name('processing');

    // Display all orders for the authenticated user
    Route::get('/my-orders', 'allOrders')->middleware('auth')->name('allOrders');

    // Display details of a specific order
    Route::get('order/details/{order}', 'details')->name('details');
});

// ===================================================================================
// Customer Conversation

// 
Route::get('/Chat', [CustomerController::class, 'conversations'])->middleware('auth')->name('conversations');

Route::post('send-customer-message', [CustomerController::class, 'storeCustomerMessage'])->middleware('auth')->name('storeCustomerMessage');


// ===================================================================================
// ADMIN ROUTES (Requires authentication & admin/super admin middleware)

require __DIR__ . '/admin.php';


// ===================================================================================
// Profile Routes (Requires authentication & admin/super admin middleware)

Route::middleware(['auth', 'adminOrSuperAdmin'])->group(function () {
    // Edit profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    // Update profile
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Delete profile
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===================================================================================
// Authentication Routes
require __DIR__ . '/auth.php';


// ===================================================================================
Route::get('contact', [MessageController::class, 'contact'])->name('contact');
Route::post('contact/store', [MessageController::class, 'store'])->name('contact.store');
// ===================================================================================

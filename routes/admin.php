<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Translation\MessageCatalogue;

// ADMIN ROUTES (Requires authentication & admin/super admin middleware)

Route::name('admin.')->prefix("admin")->middleware(['auth', 'adminOrSuperAdmin'])->group(function () {

    // Admin dashboard (accessible by both admin and super admin)
    Route::get('/', [AdminController::class, 'dashboard'])->name('index');

    // ===================================================================================
    // Super Admin Routes (restricted to Super Admin users)
    Route::controller(AdminController::class)->middleware('SuperAdmin')->group(function () {

        // View all admins
        Route::get('/view', 'viewAdmins')->name('viewAll');

        // Search for a specific admin
        Route::post("search-admin", 'searchAdmin')->name('searchAdmin');

        // View details of a specific admin
        Route::get("view-specific-admin/{admin}", 'viewSpecificAdmin')->name('viewSpecificAdmin');

        // Add a new admin
        Route::get('/create', 'createAdmin')->name('create');

        // Show details of a specific admin
        Route::get('/show-admin/{admin}', 'show_admin')->name('show');

        // Edit specific admin details
        Route::get('/edit-admin/{admin}', 'edit_admin')->name('edit');

        // Update admin details
        Route::post('/update-admin', 'updateAdmin')->name('updateAdmin');

        // Delete an admin
        Route::delete('/destroy/{admin}', 'destroyAdmin')->name('destroy');
    });

    // ===================================================================================
    // Admin and Super Admin Routes (shared by both roles)
    Route::controller(CustomerController::class)->middleware('adminOrSuperAdmin')->group(function () {

        // View all customers
        Route::get('/viewCustomers', 'viewCustomers')->name('viewAllCustomers');

        // View specific customer details
        Route::get('/show-customer/{customer}', 'show_customer')->name('showCustomer');

        // Edit customer details
        Route::get('/edit-customer/{customer}', 'edit_customer')->name('editCustomer');

        // Update customer details
        Route::post('/update-customer', 'updateCustomer')->name('updateCustomer');

        // Delete a customer
        Route::delete('/customers/{customer}', 'destroyCustomer')->name('destroyCustomer');

        // View active customers
        Route::get('/active-customers', 'activeCustomers')->name('activeCustomers');

        // View inactive customers
        Route::get('/inactive-customers', 'inactiveCustomers')->name('inactiveCustomers');

        // Search for a specific customer
        Route::post('/search-customer', 'searchCustomer')->name('searchCustomer');

        // View details of a specific customer
        Route::get("view-specific-customer/{customer}", 'viewSpecificCustomer')->name('viewSpecificCustomer');
    });

    // =======================================================================================
    // Categories Management
    Route::resource('categories', CategoryController::class);
    Route::get("view-category-products/{category}", [CategoryController::class, 'viewCategoryProducts'])->name('viewCategoryProducts');
    Route::get("view-specific-category/{category}", [CategoryController::class, 'viewSpecificCategory'])->name('viewSpecificCategory');

    // =======================================================================================
    // Products Management
    Route::resource('products', ProductController::class);
    Route::post("search-product", [ProductController::class, 'searchProduct'])->name('searchProduct');
    Route::get("view-specific-product/{product}", [ProductController::class, 'viewSpecificProduct'])->name('viewSpecificProduct');

    // =======================================================================================
    // Admin Orders Routes
    Route::controller(OrderController::class)->group(function () {
        // View all orders
        Route::get("view-all-orders", 'viewAll')->name('viewAllOrders');

        // View a specific order
        Route::get("show-order/{order}", 'show')->name('showOrder');

        // Cancel an order
        Route::post("cancel-order/{order}", 'cancelOrder')->name('cancelOrder');

        // Delete an order
        Route::delete("delete-order/{order}", 'deleteOrder')->name('deleteOrder');

        // View items in a specific order
        Route::get("show-order-items/{order}", 'showOrderItems')->name('showOrderItems');

        // View all cancelled orders
        Route::get("view-all-cancelled-orders", 'viewCancelledOrders')->name('viewAllCancelledOrders');

        // View all processing orders
        Route::get("view-all-processing-orders", 'processingOrders')->name('viewAllProcessingOrders');

        // Mark an order as shipped
        Route::post("shipping-orders", 'shippingOrders')->name('shippingOrders');

        // Mark an order as delivered and paid
        Route::post("delivered-and-paid-orders/{order}", 'deliveredAndPaid')->name('deliveredAndPaid');

        // View all shipped orders
        Route::get("view-all-shipped-orders", 'shippedOrders')->name('viewAllShippedOrders');

        // View all delivered orders
        Route::get("view-all-delivered-orders", 'showDeliveredOrders')->name('viewAllDeliveredOrders');

        // Search for an order
        Route::post("search-order", 'searchOrder')->name('searchOrder');

        // View details of a specific order
        Route::get("view-specific-order/{order}", 'viewSpecificOrder')->name('viewSpecificOrder');

        // View orders of a specific customer
        Route::get("view-customer-orders/{customer}", 'viewCustomersOrders')->name('viewCustomersOrders');
    });

    // =======================================================================================
    // Admin Coupons Routes
    Route::resource('coupons', CouponController::class);

    // =======================================================================================
    // Payments Management
    Route::resource('payments', PaymentController::class);
    Route::post("search-payment", [PaymentController::class, 'searchOrderPayment'])->name('searchOrderPayment');
    Route::get("view-specific-Payment/{payment}", [PaymentController::class, 'viewSpecificPayment'])->name('viewSpecificPayment');
    Route::get("view-customer-payments/{customer}", [PaymentController::class, 'viewCustomersPayments'])->name('viewCustomersPayments');

    // =======================================================================================
    // Admin Messages Routes
    Route::get("messages", [MessageController::class, 'index'])->name('viewMessages');
    Route::get("unread-message", [MessageController::class, 'unReadMessages'])->name('unReadMessages');
    Route::get("show/message/{message}", [MessageController::class, 'show'])->name('showMessage');
    Route::delete("destroy-messages/{message}", [MessageController::class, 'destroy'])->name('destroyMessage');

    
    // =======================================================================================
    // Admin Messages Routes
    Route::resource('conversations', ConversationController::class)->except(['index', 'destroy']);
    Route::delete('admin/conversations/{conversation}', [ConversationController::class, 'destroy'])->name('conversations.destroy');
    Route::get('/Show-Conversation/{conversation_id?}', [ConversationController::class, 'index'])->name('conversations.index');
    Route::get('/conversation/viewProfile/{customer_id}', [ConversationController::class, 'viewProfile'])->name('conversations.viewProfile');
    
    // GET|HEAD        admin/conversations ....................... admin.conversations.index › ConversationController@index  
    // POST            admin/conversations ....................... admin.conversations.store › ConversationController@store  
    // GET|HEAD        admin/conversations/create .............. admin.conversations.create › ConversationController@create  
    // GET|HEAD        admin/conversations/{conversation} .......... admin.conversations.show › ConversationController@show  
    // PUT|PATCH       admin/conversations/{conversation} ...... admin.conversations.update › ConversationController@update  
    // DELETE          admin/conversations/{conversation} .... admin.conversations.destroy › ConversationController@destroy  
    // GET|HEAD        admin/conversations/{conversation}/edit ...... admin.conversations.edit › ConversationController@edit  

});

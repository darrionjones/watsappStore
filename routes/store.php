<?php

use App\Http\Controllers\Customer\Auth\CustomerLoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StoreController;
use App\Http\Middleware\InitializeStoreByDomainOrSubDomain;
use Illuminate\Support\Facades\Route;

Route::middleware([
    InitializeStoreByDomainOrSubDomain::class
])->group(function () {
    Route::get('store/{view?}', [StoreController::class, 'storeSlug'])->name('store.slug');

    Route::post('store-product', [StoreController::class, 'filterproductview'])->name('filter.product.view');

    /* Customer Registration */
    Route::get('{slug}/user-create', [StoreController::class, 'userCreate'])->name('store.usercreate');
    Route::post('{slug}/user-create', [StoreController::class, 'userStore'])->name('store.userstore');

    /* Customer Login */
    Route::get('{slug}/customer-login', [CustomerLoginController::class, 'showLoginForm'])->name('customer.loginform');
    Route::post('{slug}/customer-login/{cart?}', [CustomerLoginController::class, 'login'])->name('customer.login');
    Route::post('{slug}/customer-logout', [CustomerLoginController::class, 'logout'])->name('customer.logout');

    /** Customer Profile */
    Route::middleware('customerauth')->group(function () {
        Route::get('{slug}/customer-profile/{id}', [CustomerLoginController::class, 'profile'])->name('customer.profile');
        Route::put('{slug}/customer-profile/{id}', [CustomerLoginController::class, 'profileUpdate'])->name('customer.profile.update');
        Route::put('{slug}/customer-profile-password/{id}', [CustomerLoginController::class, 'updatePassword'])->name('customer.profile.password');
    });

    Route::get('store/product/{order_id}/{customer_id}/{slug}', [StoreController::class, 'orderview'])->name('store.product.product_order_view');

    Route::post('add-to-cart/{slug?}/{id}/{variant_id?}', [StoreController::class, 'addToCart'])->name('user.addToCart');

    Route::post('user-product_qty/{slug?}/product/{id}/{variant_id?}', [StoreController::class, 'productqty'])->name('user-product_qty.product_qty');

    Route::post('{slug}/paystack/store-slug/', [StoreController::class, 'storesession'])->name('paystack.session.store');
    Route::get('paystack/{slug}/{code}/{order_id}', [PaymentController::class, 'paystackPayment'])->name('paystack');

    Route::get('store-complete/{slug?}/{id}', [StoreController::class, 'complete'])->name('store-complete.complete');

    //TODO: Order flow routes for customers
});


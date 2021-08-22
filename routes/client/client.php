<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [\App\Http\Controllers\Client\ClientController::class,"index"])->name('client_index');

Route::group(['prefix' => '/client'], function () {
    Route::get('/test', [\App\Http\Controllers\Client\ClientController::class,"test"])->name('test');
    //Index
 
    
    //Product
    Route::get('/product', [\App\Http\Controllers\Client\ClientController::class,"product"])->name('client_product');

    //Single
    Route::get('/product/{id}-{href_param}.html', [\App\Http\Controllers\Client\ClientController::class,"single"])->name('client_single');
    
    //Checkout
    Route::post('/uptoDB', [\App\Http\Controllers\Client\ClientController::class,"checkout"])->name('client_checkout');

    //Update Quantity
    Route::post('/update', [\App\Http\Controllers\Client\ClientController::class,"update"])->name('client_updateQuantity');

    //CheckoutGet
    Route::get('/checkout', [\App\Http\Controllers\Client\ClientController::class,"showCart"])->name('client_showCart');

    //Process Cart
    Route::post('/process', [\App\Http\Controllers\Client\ClientController::class,"process"])->name('client_process');

    //User information
    Route::get('/user', [\App\Http\Controllers\Client\ClientController::class,"userInfo"])->name('client_user');

    //User update
    Route::post('/userUpdate', [\App\Http\Controllers\Client\ClientController::class,"userUpdate"])->name('client_userUpdate');

    //OrderDetails
    Route::get('/order/{id}', [\App\Http\Controllers\Client\ClientController::class,"orderDetails"])->name('client_orderDetails');

    //deleteOrder
    Route::post('/deleteOrder', [\App\Http\Controllers\Client\ClientController::class,"deleteOrder"])->name('client_deleteOrder');

    //Privacy
    Route::get('/privacy', [\App\Http\Controllers\Client\ClientController::class,"privacy"])->name('client_privacy');

    //Payment
    Route::post('/payment', [\App\Http\Controllers\Client\ClientController::class,"payment"])->name('client_payment');

    //Terms
    Route::get('/terms', [\App\Http\Controllers\Client\ClientController::class,"terms"])->name('client_terms');

    //Faqs
    Route::get('/faqs', [\App\Http\Controllers\Client\ClientController::class,"faqs"])->name('client_faqs');
    
    //Help
    Route::get('/help', [\App\Http\Controllers\Client\ClientController::class,"help"])->name('client_help');
    
    //Contact
    Route::get('/contact', [\App\Http\Controllers\Client\ClientController::class,"contact"])->name('client_contact');
     
    //About
    Route::get('/about', [\App\Http\Controllers\Client\ClientController::class,"about"])->name('client_about');

    //News
    Route::get('/news', [\App\Http\Controllers\Client\ClientController::class,"news"])->name('client_news');

    Route::get('/newsdetails/{id}/{href_param}', [\App\Http\Controllers\Client\ClientController::class,"newsDetails"])->name('news_details');
});
<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'delivery-man', 'as' => 'delivery-man.'], function () {
    /* Authentication */
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('/code/captcha/{tmp}', 'DeliveryMan\Auth\LoginController@captcha')->name('default-captcha');
        Route::get('login', 'DeliveryMan\Auth\LoginController@login')->name('login');
        Route::post('login', 'DeliveryMan\Auth\LoginController@submit')->name('login.submit');
        Route::get('logout', 'DeliveryMan\Auth\LoginController@logout')->name('logout');
    });

    /* Forgot Password */
    Route::get('forgot-password', 'DeliveryMan\Auth\ForgotPasswordController@forgot_password')->name('forgot-password');
    Route::post('forgot-password', 'DeliveryMan\Auth\ForgotPasswordController@reset_password_request')->name('forgot-password.submit');

    /* Dashboard */
    Route::get('dashboard', 'DeliveryMan\DashboardController@dashboard')->name('dashboard')->middleware('auth:delivery_man');

    /* Orders */
    Route::get('orders', 'DeliveryMan\OrderController@orders')->name('orders')->middleware('auth:delivery_man');
    Route::get('order-details/{id}', 'DeliveryMan\OrderController@order_details')->name('order-details')->middleware('auth:delivery_man');
    Route::post('order/update-status', 'DeliveryMan\OrderController@update_status')->name('order.update-status')->middleware('auth:delivery_man');
    Route::post('order/send-otp', 'DeliveryMan\OrderController@send_delivery_otp')->name('order.send-otp')->middleware('auth:delivery_man');

    /* Earning */
    Route::get('earning', 'DeliveryMan\EarningController@earning')->name('earning')->middleware('auth:delivery_man');

    /* Withdraw */
    Route::get('withdraw', 'DeliveryMan\EarningController@withdraw_form')->name('withdraw.form')->middleware('auth:delivery_man');
    Route::post('withdraw/request', 'DeliveryMan\EarningController@submit_withdraw')->name('withdraw.request')->middleware('auth:delivery_man');

    /* Profile */
    Route::get('profile', 'DeliveryMan\ProfileController@profile')->name('profile')->middleware('auth:delivery_man');
    Route::post('profile/update', 'DeliveryMan\ProfileController@update_profile')->name('profile.update')->middleware('auth:delivery_man');
    Route::post('change-password', 'DeliveryMan\ProfileController@update_password')->name('profile.update-password')->middleware('auth:delivery_man');

    /* Payment Collection (COD → Digital) */
    Route::post('payment/verify', 'DeliveryMan\PaymentController@verify_payment')->name('payment.verify')->middleware('auth:delivery_man');
    Route::post('payment/razorpay-order', 'DeliveryMan\PaymentController@create_razorpay_order')->name('payment.razorpay-order')->middleware('auth:delivery_man');
    Route::post('payment/phonepe-get-url', 'DeliveryMan\PaymentController@phonepe_get_url')->name('payment.phonepe-get-url')->middleware('auth:delivery_man');
    Route::get('payment/phonepe', 'DeliveryMan\PaymentController@phonepe_payment')->name('payment.phonepe')->middleware('auth:delivery_man');
    Route::any('payment/phonepe-response', 'DeliveryMan\PaymentController@phonepe_response')->name('payment.phonepe-response');
});

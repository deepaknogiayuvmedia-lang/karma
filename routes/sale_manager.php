<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\SaleLoginController;
use App\Http\Controllers\SaleManager\ProductQuery;
use App\Http\Controllers\Web\WebController;

Route::group(['prefix' => 'sale', 'as' => 'sale.'], function () {

    Route::get('/', function () {

        return redirect()->route('sale.auth.login');
    });
    /*authentication*/
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {

        Route::get('/code/captcha/{tmp}', [SaleLoginController::class, 'captcha'])->name('default-captcha');
        Route::get('login', [SaleLoginController::class, 'login'])->name('login');
        Route::post('login', [SaleLoginController::class, 'submit'])->middleware('actch');
        Route::get('logout', [SaleLoginController::class, 'logout'])->name('logout');
    });
    // sale_manager
    Route::group(['middleware' => ['sale_manager']], function () {
        //prdouct-query
        Route::group(['prefix' => 'prdouct'], function () {

            Route::get('list', [ProductQuery::class, 'list'])->name('pro.list');
            Route::post('status', [ProductQuery::class, 'status'])->name('pro.status');
            Route::post('addQuery', [WebController::class, 'product_sales_query'])->name('pro.product_sales_query');
            Route::get('all_leads', [ProductQuery::class, 'all_leads'])->name('pro.all_leads');
            Route::get('vieworder_details/{id}', [ProductQuery::class, 'vieworder_details'])->name('pro.vieworder_details');
        });
        Route::group(['prefix' => 'query-customer'], function () {
            Route::get('edit/{id}', [ProductQuery::class, 'customer_edit'])->name('customer_edit');
            Route::put('update/{id}', [ProductQuery::class, 'customer_update'])->name('customer_update');
            Route::get('order/{id}', [ProductQuery::class, 'create_order'])->name('create_order');
            Route::post('/addproduct_ajax', [ProductQuery::class, 'addproduct_ajax'])->name('addproduct_ajax');
            Route::post('/deleterow', [ProductQuery::class, 'deleterow'])->name('deleterow');
            Route::post('/inserteditorder', [ProductQuery::class, 'inserteditorder'])->name('inserteditorder');
            Route::post('/filtermasters_ajax', [ProductQuery::class, 'filtermasters_ajax'])->name('filtermasters_ajax');
            Route::post('/updateqty', [ProductQuery::class, 'updateqty'])->name('updateqty');
            Route::post('/create_followup', [ProductQuery::class, 'create_followup'])->name('create_followup');
        });

    });

});

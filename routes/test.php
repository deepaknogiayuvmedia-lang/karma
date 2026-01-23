<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use LaravelQRCode\Facades\QRCode;
use Madnest\Madzipper\Facades\Madzipper;

/*Route::get('zip-extract', function () {
    Madzipper::make('test-zip.zip')->extractTo('public');
});*/

/*Route::get('/view-test', function () {
    view('welcome');
});*/


/*Route::get('qr-code', function () {
    return QRCode::text('Laravel QR Code Generator!')
        ->setOutfile(env('PUBLIC_STORAGE_PATH').'/deal/2021-10-30-617d68a9a7e8b.png')
        ->png();
});*/

use App\CPU\Helpers;
Route::get('aws-data', function () {
    return "bdsb";
    return view('installation.step5');
    $mail_config = Helpers::get_business_settings('mail_config');
     return $mail_config['status']??0;
    return view('welcome');
});
Route::get('order-email',function(){
    //Mail::to('safayet2218@gmail.com')->send(new \App\Mail\OrderPlaced(100206));
    $id = 100207;
    return view('email-templates.order-placed-v2',compact('id'));
});
Route::post('aws-upload', function (Request $request) {
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $imageName = time() . '.' . $request->image->extension();

    $path = Storage::disk('s3')->put('images', $request->image);
    $path = Storage::disk('s3')->url($path);

    dd($path);
    /* Store $imageName name in DATABASE from HERE */
    return back()
        ->with('success', 'You have successfully upload image.')
        ->with('image', $path);
})->name('aws-upload');
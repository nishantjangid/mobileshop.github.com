<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MailController;

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

Route::get('/login', function () {
    if(Session::has('user'))
    {
        return redirect('/');
    }else{
        return view('login');

    }
});
Route::get('/', function () {
    return view('home');
});
Route::get('/logout', function () {
    Session::forget('user');
    return redirect('/login');
});
Route::group(['middleware'=>['ProtectPage']],function(){
    Route::post('/add_to_cart',[ProductController::class,'addToCart']);
    Route::get('cart',[ProductController::class,'cartDetails']);
    Route::get('/delete/{id}',[ProductController::class,'deleteItemFromCart']);
    Route::get('/myaccount',[UserController::class,'myaccount']);
    Route::post('/customerUpdate',[UserController::class,'customerUpdate']);
    Route::view('/myaccount/delete-account','delete_account');
    Route::get('/deleteAccount',[UserController::class,'accountDelete']); 
    Route::get('/cart/payments',[ProductController::class,'payments']);
    Route::post('/finalpayment',[ProductController::class,'finalPayments']);
    Route::post('/stripePayment',[ProductController::class,'stripePayment']);
});
Route::post('changePrice',[ProductController::class,'changePrice']);
Route::get('shop/{filter}',[ProductController::class,'getShopProduct']);

Route::get('/search',[ProductController::class,'searchProduct']);
Route::get('details/{productTitle}',[ProductController::class,'productDetails']);
Route::view('registration','registration');
Route::post('/login',[UserController::class,'login']);
Route::post('registration',[UserController::class,'registration']);
Route::view('productUpload','productsUpload');
Route::post('insertProducts',[ProductController::class,'insertProducts']);
Route::get('/',[ProductController::class,'getHomeProducts']);
Route::get('shop',[ProductController::class,'getShopProduct']);
Route::view('/contact-us','contact_us');
Route::post('/contactus',[MailController::class,'SendEmail']);
// Route::get('/detail',[ProductController::class,'proMayLike']);


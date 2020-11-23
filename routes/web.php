<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\SliderController;

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
    Route::get('/cart/checkout',[ProductController::class,'payments']);
    Route::post('/finalpayment',[ProductController::class,'finalPayments']);
    Route::post('/stripePayment',[ProductController::class,'stripePayment']);
    Route::get('/wishlist/{id}',[ProductController::class,'wishlist']);
    Route::get('/wishlist',[ProductController::class,'wishLists']);
    Route::get('delete-wishlist/{id}',[ProductController::class,'DeletewishList']);
    Route::get('addtocart/{id}',[ProductController::class,'wishlistToCart']);
});
Route::post('changePrice',[ProductController::class,'changePrice']);
Route::get('shop/{filter}',[ProductController::class,'getShopProduct']);

Route::get('/search',[ProductController::class,'searchProduct']);
Route::get('details/{productUrl}',[ProductController::class,'productDetails']);
Route::view('registration','registration');
Route::post('/login',[UserController::class,'login']);
Route::post('registration',[UserController::class,'registration']);
// Route::view('productUpload','productsUpload');
Route::get('/',[ProductController::class,'getHomeProducts']);
Route::get('shop',[ProductController::class,'getShopProduct']);
Route::view('/contact-us','contact_us');
Route::post('/contactus',[MailController::class,'SendEmail']);
// Route::get('/detail',[ProductController::class,'proMayLike']);

// Admin area routes

Route::get('/admin-area',[AdminController::class,'DashboardCharts']);
Route::get('/admin-area/view-products',[AdminController::class,'allProduct']);
Route::get('/admin-area/insert-products',[AdminController::class,'porductCategory']);
Route::post('insertProducts',[AdminController::class,'insertProducts']);
Route::get('/admin-area/delete-product/{id}',[AdminController::class,'deleteProduct']);
Route::get('/admin-area/edit-product/{id}',[AdminController::class,'editProductview']);
Route::post('/admin-area/updateProduct',[AdminController::class,'updateProduct']);

Route::get('/admin-area/insert-product-category',[AdminController::class,'ProductCategoryShow']);
Route::post('/insertProductCategory',[AdminController::class,'insertProductCategory']);
Route::get('/admin-area/view-product-category',[AdminController::class,'viewProductCategory']);
Route::get('/admin-area/delete-product-category/{id}',[AdminController::class,'deleteProductCategory']);
Route::get('/admin-area/edit-product-category/{id}',[AdminController::class,'editProductCategory']);

Route::post('/admin-area/updateProductCategory',[AdminController::class,'updateProductCategory']);
Route::get('/admin-area/view-slider',[SliderController::class,'index']);
Route::get('/admin-area/insert-slider',[SliderController::class,'index']);
Route::resource('/slider',SliderController::class);





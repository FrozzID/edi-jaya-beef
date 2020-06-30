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

// Route::get('/', function () {
//     return view('index');
// });

//menu
Route::get('/menu', 'MenuController@index')->name('menu');
Route::get('/menu/{slug}', 'MenuController@show')->name('menu.slug');

Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'IndexController@index')->name('index');


Route::get('/services', 'IndexController@service');

Route::get('/about', 'IndexController@about');

Route::get('/single', 'IndexController@single');

//CART
Route::get('/cart', 'CartController@index');
Route::delete('/cart/remove/{id}', 'CartController@destroy')->name('cart.destroy');
Route::post('/cart/{id_product}/{id_user}', 'CartController@store')->name('cart.store');
Route::post('/cart/update', 'CartController@update');

Route::get('/contact', 'IndexController@contact');
Route::post('/contact', 'MailController@index');

//checkout
Route::get('/checkout/{id}', 'CheckoutController@index');
Route::get('/province', 'CheckoutController@get_province');
Route::get('/kota/{id}', 'CheckoutController@get_city');
Route::get('/origin={city_origin}&destination={city_destination}&weight={weight}&courier={courier}', 'CheckoutController@get_ongkir');
Route::post('/checkout/{id}', 'CheckoutController@store')->name('checkout.store');

//User
Route::get('/user/{id}', 'UserController@index');
Route::put('/user/{id}', 'UserController@update');

//transaksi
Route::get('transaksi', 'TransaksiController@index');
Route::get('transaksi/{id_transaksi}', 'TransaksiController@detail');
Route::put('transaksi/{id_transaksi}', 'TransaksiController@update');
Route::put('/transaksi/{id_transaksi}/{user_id}', 'TransaksiController@selesai');


Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', 'Admin\DashboardController@index')->name('dashboard');

    Route::resource("examples", "Admin\AdminController");

    Route::resource("transactions", "Admin\TransactionController");
});

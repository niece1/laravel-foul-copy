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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::view('about', 'about'); // shortened web rout example

Route::get('contacts', 'ContactsController@create')->name('contacts');
Route::post('contacts', 'ContactsController@store');

Route::get('articles', 'ArticlesController@index')->name('article')->middleware('auth');
Route::get('articles/create', 'ArticlesController@create')->name('articles.create');
Route::post('articles', 'ArticlesController@store')->name('articles.store');
Route::get('articles/{article}', 'ArticlesController@show')->name('article.show');
Route::get('articles/{article}/edit', 'ArticlesController@edit')->name('article.edit');
Route::patch('articles/{article}', 'ArticlesController@update');
Route::delete('articles/{article}', 'ArticlesController@destroy');

Route::get('categories', 'CategoriesController@index')->name('categories');
Route::get('categories/create', 'CategoriesController@create')->name('categories.create');
Route::post('categories', 'CategoriesController@store')->name('categories.store');
Route::delete('categories/{category}', 'CategoriesController@destroy');

Route::get('categories/{category}', 'CategoriesController@list')->name('category');

Route::get('tags', 'TagsController@index')->name('tags');
Route::get('tags/create', 'TagsController@create')->name('tags.create');
Route::post('tags', 'TagsController@store')->name('tags.store');
Route::delete('tags/{tag}', 'TagsController@destroy');

Route::get('tags/{tag}', 'TagsController@list')->name('tag');

Route::get('users', 'UsersController@index')->name('users');

Route::get('subscribers', 'SubscribersController@index')->name('subscribers');
Route::post('contact', 'SubscribersController@store');

Route::get('blog', 'ArticlesController@list')->name('blog');
Route::get('blog/{one}', 'ArticlesController@listshow')->name('blog-one');

Route::get('download/', 'HomeController@download')->name('download');

Route::resource('products', 'ProductsController');

Route::get('shop', 'ShopController@index')->name('shop');
Route::get('shop/{product}', 'ShopController@show')->name('shop.show');

Route::get('cart', 'CartController@index')->name('cart.index');
Route::post('cart', 'CartController@store')->name('cart.store');
Route::patch('cart/{product}', 'CartController@update')->name('cart.update');
Route::delete('cart/{product}', 'CartController@destroy')->name('cart.destroy');
Route::post('cart/switchToSaveForLater/{product}', 'CartController@switchToSaveForLater')->name('cart.switchToSaveForLater');

Route::delete('/saveForLater/{product}', 'SaveForLaterController@destroy')->name('saveForLater.destroy');
Route::post('/saveForLater/switchToCart/{product}', 'SaveForLaterController@switchToCart')->name('saveForLater.switchToCart');

Route::get('/checkout', 'CheckoutController@index')->name('checkout.index')->middleware('auth');
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');
Route::get('/guestCheckout', 'CheckoutController@index')->name('guestCheckout.index');

Route::get('thank-you', 'ConfirmationController@index')->name('confirmation.index');

Route::post('/coupon', 'CouponsController@store')->name('coupon.store');
Route::delete('/coupon', 'CouponsController@destroy')->name('coupon.destroy');

Route::get('/posts', function () {
    return view('posts');
});

Route::resource('books', 'BookController')->middleware('auth');

Route::get('customers', 'CustomerController@index')->name('customers');
Route::get('customers/any', 'CustomerController@getCustomers')->name('get.customers');

Auth::routes();
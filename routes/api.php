<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1','middleware' => ['localization'] ],function(){

	// USER API ROUTES
	Route::post('register'        , 'Api\UserController@register')->name('register');
	Route::post('login'           , 'Api\UserController@login')->name('login');
	Route::post('forget/password' , 'Api\UserController@__invoke')->name('__invoke');
	Route::post('profile'         , 'Api\UserController@profile')->name('profile');
	Route::post('update-user'     ,'Api\UserController@updateProfile')->name('update-user');
	Route::post('update-pic'      , 'Api\UserController@updatePic')->name('update-pic');
	Route::post('change-password' , 'Api\UserController@changePassword')->name('profile');
	Route::post('check_token'     , 'Api\UserController@checkToken')->name('profile');
	Route::post('update_device_id', 'Api\UserController@updateDeviceId')->name('profile');
	Route::post('device_token'    , 'Api\UserController@deviceToken');

	// ADDRESS API ROUTES
	Route::get('governorates'     , 'Api\GlobalController@governorates');
	Route::get('provinces'        , 'Api\GlobalController@provinces');
	Route::post('add_address'     , 'Api\UserController@address')->name('address');
	Route::post('get_address'     , 'Api\UserController@getAddress')->name('my_address');
	Route::post('update_address'  , 'Api\UserController@updateAddress')->name('update');

	// PREVIEW
	Route::get('services'         , 'Api\PreviewController@services');
	Route::post('make_preview'    , 'Api\PreviewController@makePreview');
	Route::post('my_previews'     , 'Api\PreviewController@myPreviews');
	Route::post('my_preview/{id}' , 'Api\PreviewController@myPreview');

	// GLOBAL API ROUTES
	Route::get('settings'         , 'Api\GlobalController@settings');
	Route::get('setting'          , 'Api\GlobalController@setting');
	Route::get('pages'            , 'Api\GlobalController@allPages')->name('pages');
	Route::get('page/{id}'        , 'Api\GlobalController@page')->name('page');
	Route::post('contactus'       , 'Api\ApiController@contactus');

	// STORE API ROUTES
	Route::get('products'         , 'Api\StoreController@products');
	Route::get('product/{id}'     , 'Api\StoreController@product');
	Route::post('make_order'      , 'Api\StoreController@makeOrder');
	Route::post('my_orders'       , 'Api\StoreController@myOrders');
	Route::post('my_order/{id}'   , 'Api\StoreController@getOrder');

	// PAYMENT API -- SUCCESS OR FAIELD
	Route::get('success','Payment\OrderPaymentController@success')->name('ApiSuccess');
	Route::get('failed' ,'Payment\OrderPaymentController@error')->name('ApiFailed');


});

<?php

Route::group([ 'prefix' => LaravelLocalization::setLocale() ,'middleware' => 
			 [ 'localizationRedirect', 'localeSessionRedirect']],function(){

    /*
    |================================================================================
    |                             BACKEND ROUTES
    |================================================================================
    */

	Route::group(['prefix'=>'dashboard','middleware'=>['auth','permission:admin_dashboard']],function(){

        Route::get('/'                      ,'Admin\AdminController@index')->name('admin');
        
        //Users Routes 
        Route::resource('/users'            ,'Admin\UserController');

        //Roles Routes 
        Route::resource('/roles'            ,'Admin\RolesController');

        //Permissions Routes
        Route::resource('/permissions'      ,'Admin\PermissionController');
        
        //Governorates Routes
        Route::resource('/governorates'     ,'Admin\GovernorateController');

        //Provinces Routes
        Route::resource('/provinces'        ,'Admin\ProvinceController');

        //Pages Routes
        Route::resource('/pages'            ,'Admin\PageController');

        //Settings Routes
        Route::resource('/settings'         ,'Admin\SettingController');
        
        //Media Routes
        Route::resource('/media'            ,'Admin\MediaController');
        
        //Orders Routes
        Route::resource('/orders'           ,'Admin\OrderController');

        //Colors Routes
        Route::resource('/colors'           ,'Admin\ColorController');

        //Categories Routes
        Route::resource('/categories'       ,'Admin\CategoryController');

        //Brands Routes
        Route::resource('/brands'           ,'Admin\BrandController');
        
        //Models Routes
        Route::resource('/models'           ,'Admin\ModelController');

        //Fuels Routes
        Route::resource('/Fuels'            ,'Admin\FuelController');

        //Features Routes
        Route::resource('/features'         ,'Admin\FeatureController');

        //Conditions Routes
        Route::resource('/conditions'       ,'Admin\ConditionController');

        //Transmissions Routes
        Route::resource('/transmissions'    ,'Admin\TransmissionController');

        //Rent Types Routes
        Route::resource('/types'            ,'Admin\RentTypeController');

        //Rent Agency Routes
        Route::resource('/agencies'         ,'Admin\AgenciesController');

        //Cars Routes
        Route::resource('/cars'             ,'Admin\CarController');

        //Orders Routes
        Route::resource('/orders'           ,'Admin\OrderController');

        //Notifications Routes
        Route::get('/notification'          ,'Admin\NotificationController@notifyForm')
        ->name('notifications');
        Route::post('/notification'         ,'Admin\NotificationController@push_notification')
        ->name('notify');
    });

    /*
    |================================================================================
    |                            FRONTEND ROUTES
    |================================================================================
    */

    Auth::routes();

    Route::get('/'  ,'Front\FrontController@index')->name('home');    
    Route::get('payment/success'        ,'Payment\PaymentController@success')->name('success');
    Route::get('payment/success/renew'  ,'Payment\PaymentController@successRenew')->name('renew');
    Route::get('payment/failed'         ,'Payment\PaymentController@error')->name('failed');

});
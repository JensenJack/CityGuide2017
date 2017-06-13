<?php

Route::group(['middleware' => ['web','admin','access.routeNeedsPermission:view-backend'], 'as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Modules\City\Http\Controllers'], function()
{
    		/*
             * For DataTables
             */
            Route::post('city/get', 'CityTableController')->name('city.get');
            /*
             * User CRUD
             */
            Route::resource('city', 'CityController',['except' => ['show']]);
});

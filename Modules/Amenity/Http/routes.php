<?php

Route::group(['middleware' => ['web','admin','access.routeNeedsPermission:view-backend'], 'as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Modules\Amenity\Http\Controllers'], function()
{
    		/*
             * For DataTables
             */
            Route::post('amenity/get', 'AmenityTableController')->name('amenity.get');
            /*
             * User CRUD
             */
            Route::resource('amenity', 'AmenityController',['except' => ['show']]);
});

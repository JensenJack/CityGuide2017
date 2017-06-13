<?php

Route::group(['middleware' => ['web','admin','access.routeNeedsPermission:view-backend'], 'as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Modules\HotelCategory\Http\Controllers'], function()
{
    		/*
             * For DataTables
             */
            Route::post('hotelcategory/get', 'HotelCategoryTableController')->name('hotelcategory.get');
            /*
             * User CRUD
             */
            Route::resource('hotelcategory', 'HotelCategoryController',['except' => ['show']]);
});

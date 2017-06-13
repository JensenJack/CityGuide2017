<?php

Route::group(['middleware' => ['web','admin', 'access.routeNeedsPermission:view-backend'], 'as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Modules\Hotel\Http\Controllers'], function()
{
    		/*
             * For DataTables
             */
            Route::post('hotel/get', 'HotelTableController')->name('hotel.get');
            /*
             * User CRUD
             */
            Route::resource('hotel', 'HotelController');

            Route::get('hotel_image_uploadform/{hotel}', 'HotelController@hotel_image_uploadform')->name('hotel.hotel_image_uploadform');
            Route::any('hotel_image/{id}','HotelController@hotel_image')->name('hotel.hotel_image');
});

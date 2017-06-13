<?php

Route::group(['middleware' => ['web','admin'], 'as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Modules\HotelSupplier\Http\Controllers'], function()
{
    		/*
             * For DataTables
             */
            Route::post('hotelsupplier/get', 'HotelSupplierTableController')->name('hotelsupplier.get');
            Route::get('hotelsupplier/hotel_list/{user_id}', 'HotelSupplierController@hotelLists')->name('hotelsupplier.hotel_list');
            /*
             * User CRUD
             */
            Route::resource('hotelsupplier', 'HotelSupplierController');
});

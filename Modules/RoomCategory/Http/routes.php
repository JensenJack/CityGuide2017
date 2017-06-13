<?php

Route::group(['middleware' => ['web','admin','access.routeNeedsPermission:view-backend'], 'as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Modules\RoomCategory\Http\Controllers'], function()
{
    		/*
             * For DataTables
             */
            Route::post('roomcategory/get', 'RoomCategoryTableController')->name('roomcategory.get');
            /*
             * User CRUD
             */
            Route::resource('roomcategory', 'RoomCategoryController');
});

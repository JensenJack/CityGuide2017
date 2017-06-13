<?php

Route::group(['middleware' => ['web','admin', 'access.routeNeedsPermission:view-backend'], 'as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Modules\Room\Http\Controllers'], function()
{
    		/*
             * For DataTables
             */
            Route::post('room/get', 'RoomTableController')->name('room.get');
            /*
             * User CRUD
             */
            Route::get('room_image_upload/{room}', 'RoomController@room_image_uploadform')->name('room.room_image_uploadform');
            Route::any('room_image/{id}','RoomController@room_image')->name('room.room_image');
            Route::resource('room', 'RoomController');
});

<?php

Route::group(['middleware' => ['web','admin'], 'as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Modules\Gallery\Http\Controllers'], function()
{
			/*
             * For DataTables
             */
            Route::post('gallery/get', 'GalleryTableController')->name('gallery.get');
            /*
             * User CRUD
             */
            Route::resource('gallery', 'GalleryController');

    		Route::any('gallery_image/{id}','GalleryController@gallery_image')->name('gallery.gallery_image');

});

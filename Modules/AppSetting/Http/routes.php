<?php

Route::group(['middleware' => ['web','admin'], 'as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Modules\AppSetting\Http\Controllers'], function()
{
   
            /*
             * App Setting
             */
            Route::get('appsetting', 'AppSettingController@showAppSetting')->name('appsetting.index');
            Route::post('appsetting', 'AppSettingController@storeAppSetting')->name('appsetting.store');
            Route::get('appsetting/restore', 'AppSettingController@restoreAppSetting')->name('appsetting.restore');
});

<?php

/**
 * All route names are prefixed with 'admin.access'.
 */
Route::group([
    'prefix'     => 'access',
    'as'         => 'access.',
    'namespace'  => 'Access',
], function () {

    /*
     * User Management
     */
    Route::group([
        'middleware' => 'access.routeNeedsPermission:manage-users',
    ], function () {
        Route::group(['namespace' => 'User'], function () {
            /*
             * For DataTables
             */
            Route::post('user/get', 'UserTableController')->name('user.get');

            /*
             * User Status'
             */
            Route::get('user/deactivated', 'UserStatusController@getDeactivated')->name('user.deactivated');
            Route::get('user/deleted', 'UserStatusController@getDeleted')->name('user.deleted');

            /*
             * User CRUD
             */
            Route::resource('user', 'UserController');

            /*
             * Specific User
             */
            Route::group(['prefix' => 'user/{user}'], function () {
                // Account
                Route::get('account/confirm/resend', 'UserConfirmationController@sendConfirmationEmail')->name('user.account.confirm.resend');

                // Status
                Route::get('mark/{status}', 'UserStatusController@mark')->name('user.mark')->where(['status' => '[0,1]']);

                // Password
                Route::get('password/change', 'UserPasswordController@edit')->name('user.change-password');
                Route::patch('password/change', 'UserPasswordController@update')->name('user.change-password');

                // Access
                Route::get('login-as', 'UserAccessController@loginAs')->name('user.login-as');
            });

            /*
             * Deleted User
             */
            Route::group(['prefix' => 'user/{deletedUser}'], function () {
                Route::get('delete', 'UserStatusController@delete')->name('user.delete-permanently');
                Route::get('restore', 'UserStatusController@restore')->name('user.restore');
            });
        });
    });

    /*
     * Role Management
     */
    Route::group([
        'middleware' => 'access.routeNeedsPermission:manage-roles',
    ], function () {
        Route::group(['namespace' => 'Role'], function () {
            Route::resource('role', 'RoleController', ['except' => ['show']]);

            //For DataTables
            Route::post('role/get', 'RoleTableController')->name('role.get');
        });
    });

    Route::group(['middleware'=>'access.routeNeedsPermission:manage-user'],function () {
        
        Route::group(['namespace' => 'Member'], function () {
            Route::resource('member', 'MemberController');

            // For DataTables
              Route::post('member/get', 'MemberTableController')->name('member.get');
              Route::get('password/{member}/change', 'MemberPasswordController@edit')->name('member.change-password');
              Route::patch('password/{member}/change', 'MemberPasswordController@update')->name('member.change-password');
        });

        Route::group(['namespace' => 'Supplier'], function () {
            Route::resource('supplier', 'SupplierController');

            // For DataTables
               Route::post('supplier/get', 'SupplierTableController')->name('supplier.get');
              Route::get('supplier/password/{supplier}/change', 'SupplierPasswordController@edit')->name('supplier.change-password');
              Route::patch('supplier/password/{supplier}/change', 'SupplierPasswordController@update')->name('supplier.change-password');
        });

    });

    
});

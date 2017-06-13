<?php

/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', 'FrontendController@index')->name('index');
Route::get('page/{name}', 'FrontendController@page');
Route::get('macros', 'FrontendController@macros')->name('macros');
/**
 * For Frontend Views
 */
Route::get('typeahead_city/{city}', 'FrontendController@typeahead_city')->name('typeahead_city');
Route::get('all_rooms', 'FrontendController@all_rooms')->name('all_rooms');
Route::get('search_rooms', 'FrontendController@search_rooms')->name('search_rooms');
Route::get('room_details/{id}', 'FrontendController@room_details')->name('room_details');
Route::get('find_rooms', 'FrontendController@find_rooms')->name('find_rooms');
Route::get('sorting_price/{rooms}/{sort_method}', 'FrontendController@sorting_price')->name('sorting_price');
Route::get('get_rooms_with_city/{hotel_id}', 'FrontendController@getRoomswithCity')->name('get_rooms_with_city');

Route::post('/member_login', 'FrontendController@member_login');


Route::get('/booking/{id}', 'BookingController@index');
Route::post('/booking/confirmation', 'BookingController@confirmation');
Route::get('/booking/payment_confirmation/{method}/{encrypt_booking_id}', 'BookingController@payment_confirmation');
Route::any('/booking/payment_complete/{method}/{encrypt_booking_id?}', 'BookingController@payment_complete');
Route::any('/booking/payment_status/{method}/{encrypt_booking_id?}', 'BookingController@payment_status');

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 */
Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        /*
         * User Dashboard Specific
         */
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        /*
         * User Account Specific
         */
        Route::get('account', 'AccountController@index')->name('account');
        // Route::get('get-member-booking-list', 'MemberController@dt_member_booking')->name('get_member_booking_list');


        /*
         * User Profile Specific
         */
        Route::patch('profile/update', 'ProfileController@update')->name('profile.update');

        Route::post('profile/photo', 'ProfileController@uploadPhoto')->name('profile.photo');
    });
});

<?php

Route::group(['middleware' => ['web','admin'], 'as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Modules\Booking\Http\Controllers'], function()
{
    		/*
             * For DataTables
             */
            Route::post('booking/get', 'BookingTableController')->name('booking.get');


            Route::get('booking/user/{user_id}', 'BookingController@getUser')->name('booking.user.get');
            Route::get('booking/hotel/{hotelcategory_id}', 'BookingController@getHotel')->name('booking.hotelcategory.get');
            Route::get('booking/room/{hotel_id}', 'BookingController@getRoom')->name('booking.room.get');
            Route::get('booking/price/{room_id}', 'BookingController@getRoomPrice')->name('booking.price.get');
            Route::get('booking/compose_email/{id}/{invoice?}', 'BookingController@composeEmail')->name('booking.compose_email');
            Route::post('booking/sent_ticket/', 'BookingController@sentTicket')->name('booking.sent_ticket');
            Route::get('booking/send_ticket_again/{id}','BookingController@send_ticket_again')->name('booking.send_ticket_again');
            Route::post('booking/booking_payment_info', 'BookingController@booking_payment_info')->name('booking.booking_payment_info');

            Route::post('booking/change_payment/{id}','BookingController@change_payment')->name('booking.change_payment');
            Route::get('booking/view_ticket/{id}','BookingController@view_ticket')->name('booking.view_ticket');
            Route::post('booking/add_remark/{id}','BookingController@add_remark')->name('booking.add_remark');
            Route::post('delete_booking/get', 'DeleteBookingTableController')->name('delete_booking.get');
            Route::post('booking_email_booking/get/{id}', 'ViewBookingTableController')->name('booking_email.get');
            Route::get('booking/bin','BookingController@bin')->name('booking.bin');
            Route::delete('booking/booking_delete/{id?}','BookingController@booking_forcedelete')->name('booking.booking_forcedelete');
            Route::get('booking/booking_restore/{id?}','BookingController@booking_restore')->name('booking.booking_restore');
            Route::get('booking/view_booking_email/{id}','BookingController@view_booking_email')->name('booking.view_booking_email');
            Route::get('booking/complete_all_stage/{id}','BookingController@complete_all_stage')->name('booking.complete_all_stage');
            
            /*
             * User CRUD
             */
            Route::resource('booking', 'BookingController');
});

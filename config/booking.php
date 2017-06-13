<?php

return [

    /**
     * Setting for Booking
     *
     */
    'max_adult' => env('MAX_ADULT', 10),
    'email' => env('BOOKING_EMAIL', 'bnfexpress@gmail.com'),
    'before_block_min' => env('BEFORE_BLOCK_MIN', 120),
    'room_hold_min' => env('ROOM_HOLD_MIN', 5),
    'all_booking_expiry_min' => env('ALL_BOOKING_EXPIRY_MIN', 120),
    

];
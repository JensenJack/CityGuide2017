<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Booking\BookingRepository;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;


/**
 * Class MemberController
 */
class MemberController extends Controller
{
    protected $booking;
    public function __construct( BookingRepository $booking)
    {
        
        $this->booking = $booking;
    }
    


 public function dt_member_booking()
    {
        $bookings = $this->booking->get_member_bookings(access()->user()->id);
        return Datatables::of($bookings)
            ->addColumn('booking_date' , function ($bookings){
                return date('F j, Y' , strtotime($bookings->created_at));
            })
            ->addColumn('hotel', function ($bookings) {
                return 'Name:' .$bookings->hotels->name . '<br> Type: ' . $bookings->hotels->hotel_category->name. '<br> City: ' . $bookings->hotels->city->name;
            })
            ->addColumn('room', function ($bookings) {
                return 'Name:' .$bookings->room->name . '<br> Type: ' . $bookings->room->room_category->name. '<br> Quantity: ' . $bookings->quantity;
            })
            ->addColumn('check_in', function ($bookings) {
                return $bookings->check_in_date;
            })
            ->addColumn('check_out', function ($bookings) {
                return $bookings->check_out_date;
            })
            ->addColumn('amount', function ($bookings) {
                return $bookings->amount;
            })
            ->addColumn('check_in_name', function ($bookings) {
                return $bookings->check_in_name;
            })
            ->addColumn('payment_complete', function ($bookings) {
                return $bookings->payment_complete;
            })
            ->make(true);
    }
}
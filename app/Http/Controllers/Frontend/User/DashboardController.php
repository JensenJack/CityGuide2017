<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Booking\BookingRepository;
use Illuminate\Support\Facades\Input;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
	protected $booking;

	public function __construct( BookingRepository $booking)
    {
        
        $this->booking = $booking;
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
    	$bookings=$this->booking->get_member_bookings(access()->user()->id);

        return view('frontend.user.dashboard',compact('bookings'));
    }
}

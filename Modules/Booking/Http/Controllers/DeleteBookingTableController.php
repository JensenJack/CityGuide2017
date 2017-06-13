<?php

namespace Modules\Booking\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Booking\Entities\Booking;
use Yajra\Datatables\Facades\Datatables;
use Modules\Booking\Http\Requests\ManageBookingRequest;
use Modules\Booking\Repositories\BookingRepository;

class DeleteBookingTableController extends Controller
{
    /**
     * @var BookingRepository
     * @var CategoryRepository
     */
    protected $booking;

    /**
     * @param BookingRepository $booking
     */
    public function __construct(BookingRepository $booking)
    {
        $this->booking = $booking;
    }

    /**
     * @param ManageBookingRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageBookingRequest $request)
    {
        $booking_data = $this->booking->getForDeleteBookingDataTable();

        return Datatables::of( $booking_data)
            ->addColumn('booking_ref', function($booking_data){
                $data = $this->booking_status($booking_data);
                if($data['style'] == 'yellow')
                    return '<span class="list-group-item" style="color: green;text-align:center;background: ' . $data['style'] . '">' . $booking_data->booking_ref . '</span>';
                else
                    return '<span class="list-group-item bg-font-blue" style="text-align:center;background: ' . $data['style'] . '">' . $booking_data->booking_ref . '</span>';
            })
            ->filterColumn('booking_ref', function($query, $keyword){
                return $query->where('booking_ref', 'LIKE', '%' . $keyword . '%');
            })
            ->addColumn('client_info', function($booking_data){
                return $booking_data->guest_name ."( ". $booking_data->guest_email ." )<br>". $booking_data->guest_phone . "<br>NRC : ". $booking_data->guest_nrc."<br>".$booking_data->guest_type."(".$booking_data->check_in_name.")"; 
            })
            ->addColumn('hotel', function($booking_data){
                return $booking_data->hotels->name;
            })
            ->addColumn('room', function($booking_data){
                return $booking_data->room->name;
            })
            ->addColumn('booking_info', function($booking_data){
                return "Check-in Date : ". $booking_data->check_in_date . "<br>Check-out Date : " . $booking_data->check_out_date . "<br>Booking-expire : " . $booking_data->booking_expire;
            })
            ->addColumn('amount_info', function($booking_data){
                return "Total : ". $booking_data->amount . "<br>Qty : " . $booking_data->quantity . "<br>Room Price : " . $booking_data->price. "<br>Discount : " . $booking_data->discount ;
            })
            ->addColumn('status', function ($booking_data) {
                $data = $this->booking_status($booking_data);
                if($booking_data->status == 0){
                    return  $data['status'];
                }
                return $data['status'];
            })
            ->addColumn('actions', function ($slider) {
                return $slider->delete_restore;
            })
            ->make(true);
    }

    /**
    * @param $booking
    * @return array
    */
    private function booking_status($booking)
    {
        switch ($booking->status) {
            case 1 :
                return $data = [
                    'style' => 'yellow',
                    'status' => trans('booking::labels.backend.booking.status.1')
                ];
                break;

            case 2 :
                return $data = [
                    'style' => 'green',
                    'status' => trans('booking::labels.backend.booking.status.2')
                ];
                break;

            case 3 :
                return $data = [
                    'style' => 'purple',
                    'status' => trans('booking::labels.backend.booking.status.3')
                ];
                break;

            case 4 :
                return $data = [
                    'style' => 'blue',
                    'status' => trans('booking::labels.backend.booking.status.4')
                ];
                break;

            case 5 :
                return $data = [
                    'style' => 'black',
                    'status' => trans('booking::labels.backend.booking.status.5')
                ];
                break;

            default :
                return $data = [
                    'style' => 'red',
                    'status' => trans('booking::labels.backend.booking.status.0')
                ];
                break;
        }
    }
}
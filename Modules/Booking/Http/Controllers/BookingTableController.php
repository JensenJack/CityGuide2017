<?php

namespace Modules\Booking\Http\Controllers;

use Illuminate\Routing\Controller;
use Yajra\Datatables\Facades\Datatables;
use Modules\Booking\Repositories\BookingRepository;
use Modules\Booking\Http\Requests\ManageBookingRequest;

class BookingTableController extends Controller
{
    /**
     * @var BookingRepository
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
        $booking_data = $this->booking->getForDataTable();
        return Datatables::of( $booking_data)
            ->addColumn('booking_ref', function($booking_data){
                $data = $this->booking_status($booking_data);
                if($data['style'] == 'yellow')
                    return '<span class="list-group-item" style="color: green;text-align:center;background: ' . $data['style'] . '">' . $booking_data->booking_ref . '</span>';
                else
                    return '<span class="list-group-item bg-font-blue" style="color: #fff;text-align:center;background: ' . $data['style'] . '">' . $booking_data->booking_ref . '</span>';
            })
            ->filterColumn('booking_ref', function($query, $keyword){
                return $query->where('booking_ref', 'LIKE', '%' . $keyword . '%');
            })
            ->addColumn('client_info', function($booking_data){
                return $booking_data->guest_name ."( ". $booking_data->guest_email ." )<br>". $booking_data->guest_phone . "<br>NRC : ". $booking_data->guest_nrc."<br>".$booking_data->guest_type."(".$booking_data->check_in_name.")"; 
                
            })
            ->addColumn('hotel', function($booking_data){
                return $booking_data->hotels->name."<br>(".$booking_data->hotels->city->name.")";
            })
            ->addColumn('room', function($booking_data){
                return $booking_data->room->name;
            })
            ->addColumn('booking_info', function($booking_data){
                return "Check-in Date : ". $booking_data->check_in_date . "<br>Check-out Date : " . $booking_data->check_out_date . "<br>Booking-expire : " . $booking_data->booking_expire;
            })
            ->addColumn('amount_info', function($booking_data){
               return  "Qty : " . $booking_data->quantity . "<br>Room Price : " . $booking_data->price. "<br>Discount : " . $booking_data->discount . "<br>Total : ". $booking_data->amount;
            })
            ->addColumn('payment', function ($booking_data) {
                return ($booking_data->payment_complete) ? '<label class="label label-success">' . trans('booking::labels.backend.booking.table.receive') . '</label><br> ('.$booking_data->payment_method.')' : '<label class="label label-danger">' . trans('booking::labels.backend.booking.table.unpaid') . '</label><br> ('.$booking_data->payment_method.')';
            })
            ->addColumn('status', function ($booking_data) {
                $data = $this->booking_status($booking_data);
                if($booking_data->status == 0){
                    return '<a href="' . route('admin.booking.compose_email', $booking_data->id) . '">' . $data['status'] . '</a>';
                }
                return '<a href="' . route('admin.booking.show', $booking_data->id) . '">' . $data['status'] . '</a>';
            })
            ->addColumn('actions', function ($slider) {
                return $slider->action_buttons;
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

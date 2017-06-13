<?php

namespace Modules\Booking\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Booking\Entities\Booking;
use Yajra\Datatables\Facades\Datatables;
use Modules\Booking\Http\Requests\ManageBookingRequest;
use Modules\Booking\Repositories\BookingRepository;

class ViewBookingTableController extends Controller
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
    public function __invoke($id, ManageBookingRequest $request)
    {
        $booking_data = $this->booking->getForViewBookingDataTable($id);

        return Datatables::of( $booking_data)
            ->addColumn('booking_ref', function($booking_data){
                $data = $this->booking_status($booking_data);
                if($data['style'] == 'yellow')
                    return '<span class="list-group-item" style="color: green;text-align:center;background: ' . $data['style'] . '">' . $booking_data->booking->booking_ref . '</span>';
                else
                    return '<span class="list-group-item bg-font-blue" style="color: #fff;text-align:center;background: ' . $data['style'] . '">' . $booking_data->booking->booking_ref . '</span>';
            })
            ->filterColumn('booking_ref', function($query, $keyword){
                return Booking::where('booking_ref', 'LIKE', '%' . $keyword . '%');
            })
            ->addColumn('client_info', function($booking_data){
                return $booking_data->booking->guest_name ."( ". $booking_data->booking->guest_email ." )<br>". $booking_data->booking->guest_phone . "<br>NRC : ". $booking_data->booking->guest_nrc."<br>".$booking_data->booking->guest_type."(".$booking_data->booking->check_in_name.")"; 
                
            })
            ->addColumn('hotel', function($booking_data){
                return $booking_data->booking->hotels->name;
            })
            ->addColumn('room', function($booking_data){
                return $booking_data->booking->room->name;
            })
            ->addColumn('booking_info', function($booking_data){
                return "Check-in Date : ". $booking_data->booking->check_in_date . "<br>Check-out Date : " . $booking_data->booking->check_out_date . "<br>Booking-expire : " . $booking_data->booking->booking_expire;
            })
            ->addColumn('amount_info', function($booking_data){
               return  "Qty : " . $booking_data->booking->quantity . "<br>Room Price : " . $booking_data->booking->price. "<br>Discount : " . $booking_data->booking->discount . "<br>Total : ". $booking_data->booking->amount;
            })
            ->addColumn('payment', function ($booking_lists) {
                return ($booking_lists->booking->payment_complete) ? '<label class="label label-success">' . trans('booking::labels.backend.booking.table.receive') . '</label><br> ('.$booking_lists->booking->payment_method.')' : '<label class="label label-danger">' . trans('booking::labels.backend.booking.table.unpaid') . '</label><br> ('.$booking_lists->booking->payment_method.')';
            })
            ->addColumn('status', function ($booking_lists) {
                $data = $this->booking_status($booking_lists);
                
                 if($data['style'] == 'yellow')
                    return '<label class="label bg-font-blue" style="color:green; background: ' . $data['style'] . '">' . $data['status'] . '</label> - ' . $booking_lists->sender_name;
                else
                    return '<label class="label bg-font-blue" style="background: ' . $data['style'] . '">' . $data['status'] . '</label> - ' . $booking_lists->sender_name;
            })
            ->addColumn('actions', function ($slider) {
                return $slider->show_button;
            })
            ->make(true);
    }

    /**
    * @param $booking
    * @return array
    */
    private function booking_status($booking_data)
    {
        switch ($booking_data->status) {
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
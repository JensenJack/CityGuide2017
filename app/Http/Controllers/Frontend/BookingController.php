<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Requests\Frontend\BookingConfirmRequest;
use App\Http\Controllers\Controller;
use Modules\Room\Entities\Room;
use App\Repositories\Frontend\Booking\BookingRepository;

class BookingController extends Controller
{

	 protected $bookings;

	 public function __construct(BookingRepository $bookings)
    {
        $this->bookings   = $bookings;
    }
    public function index($id)
    {
        $rooms=Room::where('id',$id)->with('hotel','hotel.hotel_category','room_category')->get();;
        $room=$rooms[0];


            
               $local_price=$room->local_sell_price;
               $foreign_price=$room->foreign_sell_price;
             

            $local_service_fee=$this->bookings->getServiceFees($local_price);
            $foreign_service_fee=$this->bookings->getServiceFees($foreign_price);
   
	
    	return view('frontend.booking',compact('room','local_service_fee','foreign_service_fee'));
    }

     public function confirmation(BookingConfirmRequest $request)
    {       
        	$booking = $this->bookings->add_new_booking($request->all());
            
        	  $this->bookings->send_booking_notification_email($booking);
              $payment_method = $booking->payment_method;
              $encrypt_booking_id = \Modules\Booking\Entities\HotelEncryption::encode($booking->id);
         	return redirect('/booking/payment_confirmation/'.$payment_method.'/'.$encrypt_booking_id);
      

    }

    public function payment_confirmation($method,$encrypt_booking_id)
    {

        if($this->bookings->check_valid_booking($method,$encrypt_booking_id)){
            $booking_id = \Modules\Booking\Entities\HotelEncryption::decode($encrypt_booking_id);
            $booking = $this->bookings->find($booking_id);
            $total_amount = $booking->amount;
           
            $show_form = true;
            $currency = config('app.app_setting.currency');
            $usd_rate = config('app.app_setting.dollar_rate');

            $usd_amount = round($total_amount / floatval($usd_rate), 2);
            $mmk_amount = $total_amount;
            switch ($method) {
                case 'transfer':    $form_values = $this->bookings->transfer($encrypt_booking_id,$mmk_amount);
                                    break;
                case 'truemoney':   $form_values = $this->bookings->truemoney($encrypt_booking_id,$mmk_amount);
                                    $show_form = false;
                                    break;
                case 'visa_master': $form_values = $this->bookings->visa_master($encrypt_booking_id,$usd_amount);
                                    $currency = 'USD';
                                    break;
                case 'mab':        $form_values = $this->bookings->mab($encrypt_booking_id,$mmk_amount);
                                    break;
                case 'paypal':      $form_values = $this->bookings->paypal($encrypt_booking_id,$usd_amount);
                                    $currency = 'USD';
                                    break;
                case 'mpu':         $form_values = $this->bookings->mpu($encrypt_booking_id,$mmk_amount);
                                    break;
                default:            app()->abort('404');
            }
            return view('frontend.payment_confirmation',compact('usd_amount','mmk_amount','currency','show_form','form_values','booking','total_amount','method','encrypt_booking_id'));
        }
        app()->abort('404');
    }

    
     public function payment_complete(Request $request,$method,$encrypt_booking_id=Null)
    {
        
        if(!$encrypt_booking_id){
            if($method == 'visa_master' && $method == 'mpu') $encrypt_booking_id = $request->input('user_defined_1');
        }
        if($this->bookings->check_valid_booking($method,$encrypt_booking_id)){

            $request = $request->all();

            switch ($method) {
                case 'transfer':    $response = $this->bookings->save_transfer($encrypt_booking_id,$request);
                                    break;
                case 'visa_master': $response = $this->bookings->save_visa_master($encrypt_booking_id,$request);
                                    break;
                case 'mab':        $response = $this->bookings->save_mab($encrypt_booking_id,$request);
                                    break;
                case 'paypal':      $response = $this->bookings->save_paypal($encrypt_booking_id,$request);
                                    break;
                case 'mpu':         $response = $this->bookings->save_mpu($encrypt_booking_id,$request);
                                    break;
                case 'onetwothree': $response = $this->bookings->save_onetwothree($encrypt_booking_id,$request);
                                    break;
                default:            app()->abort('404');
            }

            return view('frontend.payment_complete',compact('response','method','encrypt_booking_id'));

        }
        else{
            app()->abort('404');
        }
    }

     public function payment_status(Request $request,$method,$encrypt_booking_id=Null)
    {
        if(!$encrypt_booking_id){
            if($method == 'visa_master' && $method == 'mpu') $encrypt_booking_id = $request->input('user_defined_1');
            if($method == 'truemoney') $encrypt_booking_id = \App\Models\Booking\HotelEncryption::encode($request->input('bookingId'));
        }
        if($this->bookings->check_valid_booking($method,$encrypt_booking_id)){

            $request = $request->all();

            switch ($method) {
                case 'truemoney':    $response = $this->bookings->save_truemoney($encrypt_booking_id,$request);
                                    break;
                case 'visa_master': $response = $this->bookings->save_visa_master($encrypt_booking_id,$request);
                                    break;
                case 'mab':        $response = $this->bookings->save_mab($encrypt_booking_id,$request);
                                    break;
                case 'mpu':         $response = $this->bookings->save_mpu($encrypt_booking_id,$request);
                                    break;
                case 'onetwothree': $response = $this->bookings->save_onetwothree($encrypt_booking_id,$request);
                                    break;
                default:            app()->abort('404');
            }

            return response()->json(['success'=>true],200);

        }
        else{
            return response()->json(['success'=>false],403);
        }
    }
}

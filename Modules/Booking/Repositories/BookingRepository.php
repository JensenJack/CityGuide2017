<?php

namespace Modules\Booking\Repositories;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Modules\Booking\Entities\Booking;
use Modules\Booking\Entities\BookingEmail;
use Modules\Email\Repositories\EmailRepository;
use Modules\Booking\Repositories\BookingEmailRepository;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BookingRepository.
 */
class BookingRepository extends Repository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Booking::class;

    /**
     * @param string $order_by
     * @param string $sort
     *
     * @return mixed
     */
    protected $booking_email;
    protected $email;


    public function __construct(Booking $booking,BookingEmailRepository $bookingEmail,EmailRepository $email)
    {
        
        $this->booking_email = $bookingEmail;
        $this->email = $email;
        $this->booking = $booking;
    }
    public function getAll($order_by = 'created_at', $sort = 'desc')
    {
        return $this->query()
            ->orderBy($order_by, $sort)
            ->get();
    }

    /**
     * @param string $order_by
     * @param string $sort
     *
     * @return mixed
     */
    public function getForDataTable($order_by = 'created_at', $sort = 'desc')
    {
        return $this->query()->with('hotels','room')
            ->orderBy($order_by, $sort)
            ->select('*');
    }

     public function create(array $input)
    {  

        if($input['member_id']){
           $input['is_guest'] = 0 ;
        }
        else
        {
          $input['is_guest'] = 1 ;
          $input['member_id'] = 0 ;
        }


          $input['booking_ref']                 = $this->get_initial_b_ref();


        return DB::transaction(function () use ($input) {
            $booking = self::MODEL;
            $booking=new $booking();
            $booking->member_id             = $input['member_id'];
            $booking->guest_name            = $input['guest_name'];
            $booking->check_in_name         = $input['check_in_name'];
            $booking->guest_email           = $input['guest_email'];
            $booking->guest_phone           = $input['guest_phone'];
            $booking->guest_nrc             = $input['guest_nrc'];
            $booking->hotel_id              = $input['hotel_id'];
            $booking->room_id               = $input['room_id'];
            $booking->quantity              = $input['quantity'];
            $booking->guest_type            = $input['guest_type'];
            $booking->price                 = $input['price'];
            $booking->amount                = $input['amount'];
            $booking->check_in_date         = $input['check_in_date'];
            $booking->check_out_date        = $input['check_out_date'];
            $booking->booking_expire        = $input['booking_expire'];
            $booking->discount              = $input['discount'];
            $booking->payment_method        = $input['payment_method'];
            $booking->payment_complete      = $input['payment_complete'];
            $booking->language              = $input['language'];
            $booking->booking_ref           = $input['booking_ref'];
            $booking->status                = 0;
            $booking->is_guest              = $input['is_guest'];
            $booking->remark                = isset($input['remark']) ? $input['remark']:" ";
            $booking->service_fee           = 0;
            $booking->note                  = "";
            $booking->bank_name             = "";
            $booking->bank_remark           = "";
          
            
            if (parent::save($booking)) {
  
                return $booking->id;     
            }

            throw new GeneralException(trans('hotel::exceptions.backend.hotel.create_error'));
        });

    }

  
    private function get_initial_b_ref()
    {
        $latest_b_ref = $this->query()->orderBy('booking_ref', 'desc')->take(1)->first();
        if (!$latest_b_ref) {
            $b_ref = 'A';
        } else {
            $b_ref = ++$latest_b_ref->b_ref;
        }

        $b_ref = str_pad($b_ref, 5, 'A', STR_PAD_LEFT);
        $b_ref = strtoupper($b_ref); //booking ref alpha
        return $b_ref;
    }

    /**
     * @return mixed
     */
   public function getForDeleteBookingDataTable()
   {
        return Booking::onlyTrashed()->get();
   }

   public function getForViewBookingDataTable($id)
   {
        return BookingEmail::with('booking')->whereHas('booking',function ($quary) use($id) {
            $quary->where('id' , $id );
        })->get();
   }

   public function change_payment($id)
    {
        $booking = $this->find($id);

        $booking->payment_complete = !$booking->payment_complete ? 1 : 0;

        if ($booking->save()) {
            \Log::info('Booking Payment'.$booking->booking_ref.' was changed by ' . access()->user()->name );
            return true;
        }
        return false;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function booking_payment_info($id)
    {
        $booking = $this->booking->where('id',$id)->first();
        return $this->payment_status($booking);
    }

    private function payment_status($booking)
    {
        switch ($booking->payment_method) {
            case 'transfer' :
                $info = 'Customer Note - ';
                $info .= $booking->note.'<br>';
                $info .= '<h3>Bank Transfer</h3>';
                $info .= $booking->bank_name . '<br>Bank Transfer Remark - ' . $booking->bank_remark;
                return $info;
                break;

            case 'mpu' :

                $status_array = [
                    'AP' => 'Approved',
                    'SE' => 'Settled',
                    'VO' => 'Voided',
                    'DE' => 'Declined',
                    'FA' => 'Declined',
                    'RE' => 'Refunded',
                    'PR' => 'Cancelled'
                ];

                if ($booking->payment_complete) {
                    $info = 'Customer Note - ';
                    $info .= $booking->note.'<br>';
                    $info .= '<h3>MPU Payment</h3><br>';
                    $data = json_decode($booking->booking_payment()->select('info')->get());
                    $json = json_decode($data[0]->info);

                    $info .= 'Payment Status - ' . @$status_array[$json->status] . '<br>';
                    $info .= 'Paid Card - ' . @$json->pan . '<br>';
                    $info .= 'Transcation Ref - ' . @$json->tranref;

                    return $info;

                }

                $info = 'Customer Note - ';
                $info .= $booking->note.'<br>';
                $info .= '<h3>MPU Payment</h3><br>Didn\'t make this payment yet!';

                return $info;

                break;

            case 'visa_master' :
                if ($booking->payment_complete) {

                    $info = 'Customer Note - ';
                    $info .= $booking->note.'<br>';
                    $info .= '<h3>Visa / Master</h3><br>';
                    $data = json_decode($booking->booking_payment()->select('info')->get());
                    $payment = json_decode($data[0]->info);

                    $status = ($payment->channel_response_code === '00') ? 'Paid' : 'Un-Paid';
                    $info .= 'Status - ' . @$status . '<br>';
                    $info .= 'Information - ' . @$payment->channel_response_desc . '<br>';
                    $info .= 'Paid Agent - ' . @$payment->paid_agent;

                    return $info;

                }

                $info = 'Customer Note - ';
                $info .= $booking->note.'<br>';

                $info .= '<h3>Visa / Master</h3><br>Didn\'t make this payment yet!';

                return $info;
                break;
                
            case 'truemoney' :
                if ($booking->payment_complete) {
                    $info = 'Customer Note - ';
                    $info .= $booking->note.'<br>';
                    $info .= '<h3>TrueMoney Payment</h3><br>';
                    $data = json_decode($booking->booking_payment()->select('info')->get());
                    $json = json_decode($data[0]->info);

                    $info .= 'TMM Ref No - ' . $json->tmmRefNo . '<br>';
                    $info .= 'Agent Ref No - ' . @$json->agentCardRef . '<br>';
                    return $info;

                }

                $info = 'Customer Note - ';
                $info .= $booking->note.'<br>';
                $info .= '<h3>TrueMoney Payment</h3><br>Didn\'t make this payment yet!';

                return $info;
                break;

            case 'mab' :
                if ($booking->payment_complete) {
                    $info = 'Customer Note - ';
                    $info .= $booking->note.'<br>';
                    $info .= '<h3>MAB Payment</h3><br>';
                    $data = json_decode($booking->booking_payment()->select('info')->get());
                    $payment = json_decode($data[0]->info);

                    $info .= 'OID No - ' . @$payment->OID . '<br>';
                    $info .= 'Status - ' . @$payment->StatusName . '<br>';
                    $info .= 'Status Code - ' . @$payment->StatusCode . '<br>';

                    return $info;
                }

                $info = 'Customer Note - ';
                $info .= $booking->note.'<br>';
                $info .= '<h3>MAB Payment</h3><br>Didn\'t make this payment yet!';

                return $info;
                break;

            case 'onetwothree' :
                if ($booking->payment_complete) {

                    $info = 'Customer Note - ';
                    $info .= $booking->note.'<br>';
                    $info .= '<h3>123 Payment</h3><br>';
                    $data = json_decode($booking->booking_payment()->select('info')->get());
                    $payment = json_decode($data[0]->info);


                    if (@$payment->ResponseCode == 0) {
                        $info .= 'Payment Status - SUCCESS (PAID) <br>';
                    } elseif (@$payment->ResponseCode == 1) {
                        $info .= 'Payment Status - PENDING <br>';
                    } elseif (@$payment->ResponseCode == 15) {
                        $info .= 'Payment Status - SUCCESS ((PAID MORE MISMATCHED)  customer paid more than transaction amount  <br>';
                    } elseif (@$payment->ResponseCode == 16) {
                        $info .= 'Payment Status - SUCCESS (PAID LESS MISMATCHED)  customer paid less than transaction amount <br>';
                    } elseif (@$payment->ResponseCode == 17) {
                        $info .= 'Payment Status - SUCCESS (PAID EXPIRED) customer paid expired transaction <br>';
                    } else {
                        $info .= 'Payment Status - PENDING <br>';
                    }

                    $info .= 'OneTwoThree Ref No - ' . @$payment->RefNo1 . '<br>';
                    $info .= 'BNF Ref No - ' . @$payment->MessageID . '<br>';
                    $info .= 'Agent Ref No - ' . @$payment->AgentCode . '<br>';
                    $info .= '<a href=\'' . $payment->SlipUrl . '\' target=\'_BLANK\'>Check PaySlip</a><br>';

                    return $info;
                }

                $info = 'Customer Note - ';
                $info .= $booking->note.'<br>';
                $info .= '<h3>123 Payment</h3><br>Didn\'t make this payment yet!';

                return $info;
                break;

            case 'paypal' :

                $info = 'Customer Note - ';
                $info .= $booking->note.'<br>';
                $info .= 'Payment has been Made By Paypal Account.';

                return $info;
                break;

            default :
                $info = 'Customer Note - ';
                $info .= $booking->note.'<br>';
                $info .= 'Deposit Account Payment';

                return $info;
                break;
        }
    }

    public function add_remark($id, $input)
    {
        $booking = $this->find($id);
        $this->find($id)->update($input);
        \Log::info('Add Remark '.$booking->b_ref.' was created by ' . access()->user()->name );
        return true;
    }

    public function complete_all_stage($id, $input)
    {
        $input = [
            'booking_id' => $id,
            'status' => 2,
            'member_id' => $input['member_id'],
            'sender_name' => access()->user()->name,
            'sender_id' => access()->user()->id,
                 ];

        $result = $this->add_new_booking_email($input);

        $this->find($id)->update([
            'status' => 2
        ]);

        return $result ? true : false;
    }

    private function add_new_booking_email($input)
    {
        
        $booking_email = $this->booking_email->create($input);
        $booking = $this->find($input['booking_id']);
        \Log::info('Add New Booking Email'.$booking->b_ref.' was created by ' . access()->user()->name );
        return $booking_email->id;
    }

    public function sent_ticket($booking, $type)
    {
        $to =$booking->guest_email;
        $result =$this->email->get_email_content($type,$booking->language);
        $subject =$result->subject;
        $message = $result->content;
        $message = str_replace('{NAME}', $booking->guest_name, $message);
        $message = str_replace('{REF_ID}', $booking->booking_ref, $message);

        $message = str_replace('{NEWLINE}', PHP_EOL, $message);

        $message = str_replace('{C_REMARK}', Session::get('c_remark'), $message);
        $message = str_replace('{C_I_TIME}', date('d M Y', strtotime($booking->check_in_date)), $message);
        $message = str_replace('{C_O_TIME}', date('d M Y',strtotime($booking->check_out_date)), $message);
        $message = str_replace('{BASE_URL}', config('app.app_setting.main_logo'), $message);
        $body = str_replace('{BASE_URL}', url('/'), $message);

        if ($type == 'cancel_booking' || $type == 'initial_booking') {

            Mail::queue([], [], function ($message) use ($to, $subject, $body) {
                $message->to($to)->subject($subject);
                $message->setBody($body, 'text/html');
            });

        }
    }

    public function final_booking_mail($input, $booking)
    {
        
        $booking_email = $input;
        $to = $booking->guest_email;

        $body = View::make('booking::ticket', compact('booking_email', 'booking'))->render();

        Mail::queue([], [], function ($message) use ($body, $to) {
            $message->to($to)->subject(app_name().' Final E-Ticket');
            $message->setBody($body, 'text/html');
        });

        \Log::info('Final Booking Mail '.$booking->booking_ref.' was send by ' . access()->user()->name );
    }

}
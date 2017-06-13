<?php

namespace App\Repositories\Frontend\Booking;

use Illuminate\Support\Facades\Mail;
use Modules\Booking\Entities\Booking;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;
use Modules\Booking\Entities\HotelEncryption;
use Modules\Booking\Entities\Payment;

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

	 public function get_member_bookings($id)
    {
        return Booking::where('member_id', $id)->with('hotels', 'room','hotels.hotel_category','room.room_category')->paginate(10);
    }

    public function add_new_booking($input)
    {

        if (@auth()->user()->id) {
            $input['is_guest'] = 0;
            $input['member_id'] = auth()->user()->id;
            $input['guest_name'] = auth()->user()->name;
            $input['guest_phone'] = auth()->user()->phone_number;
            $input['guest_email'] = auth()->user()->email;

           
        } else {
            $input['is_guest'] = 1;
            $input['member_id'] = 0;
            $input['guest_name'] = $input['name'];
            $input['guest_phone'] = $input['guest_phone'];
            $input['guest_email'] = $input['email'];
        }

      
        $input['check_in_name'] = $input['check_in_name'];
        $input['booking_ref'] = $this->get_initial_b_ref();
        
        $before_block_min = config('booking.all_booking_expiry_min');
        $input['booking_expire'] = date('Y-m-d H:i:s', strtotime('+' . $before_block_min . ' minutes'));

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
            $booking->check_in_date         = $input['start'];
            $booking->check_out_date        = $input['end'];
            $booking->booking_expire        = $input['booking_expire'];
            $booking->discount              = 0;
            $booking->payment_method        = $input['payment_method'];
            $booking->payment_complete      = 0;
            $booking->language              = $input['language'];
            $booking->booking_ref           = $input['booking_ref'];
            $booking->status                = 0;
            $booking->is_guest              = $input['is_guest'];
            $booking->remark                = isset($input['remark']) ? $input['remark']:" ";
            $booking->service_fee           = $input['service_fee'];
            $booking->note                  = $input['note'];
            $booking->bank_name             = '';
            $booking->bank_remark           = '';
          
            
            if (parent::save($booking)) {
  
                return $booking;     
            }

            throw new GeneralException(trans('hotel::exceptions.backend.hotel.create_error'));
        });

    }

    public function send_booking_notification_email($booking, $ostype = NULL)
    {
        if ($booking->member_id) {
            $member = 'Member ID : ' . $booking->member_id . " <br> ";
        } else {
            $member = "Guest Member Booking <br> ";
        }
        
        

        $todayis = date("l, F j, Y, g:i a");
        $ip = $_SERVER['REMOTE_ADDR'];

        $body =
            $member
            . "Member Name: $booking->guest_name<br> "
            . "Email: $booking->guest_email<br> "
            . "Mobile: $booking->guest_phone<br> "
            . "Check In Name: $booking->check_in_name<br> "
            . "NRC No. : $booking->guest_nrc<br><br> "
            . "Payment Method. : $booking->payment_method<br> "
            . "Booking ref: $booking->booking_ref<br> <br>"
            . "Quantity: $booking->quantity<br> <br>"
            . "Room id: R$booking->room_id<br> "
            . "Check In Date: $booking->check_in_date<br> "
            . "IP: $ip<br> "
            . "Booking Date: $todayis<br> ";

        $subject = app_name() . " New Booking Notification";
        $to = config('booking.email');

        $response = Mail::queue([], [], function ($message) use ($to, $subject, $body) {
            $message->subject($subject);
            $message->setBody($body, 'text/html');
            $message->to($to);
        });
    }

     public function check_valid_booking($method, $encrypt_booking_id)
    {
        $booking_id = HotelEncryption::decode($encrypt_booking_id);
        if (Booking::find($booking_id)->payment_method == $method) {
            return true;
        }
        return false;
    }

    private function get_initial_b_ref()
    {
        $latest_b_ref = Booking::withTrashed()->orderBy('booking_ref', 'desc')->take(1)->first();
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
     * @param amount
     * @return array
     */
    public function getServiceFees($amount)
    {
        $service_fee['paylater_fee'] = '';
        $service_fee['ok_fee'] = '';
        $service_fee['paypal_fee'] = '';
        $service_fee['mpu_fee'] = '';
        $service_fee['transfer_fee'] = '';
        $service_fee['visa_master_fee'] = '';
        $service_fee['mab_fee'] = '';
        $service_fee['onetwothree_fee'] = '';
        $service_fee['truemoney_fee'] = '';
        $service_fee['deposite_fee'] = '';

        if (config('payment.paylater.enable') == "true") {
            if (config('payment.paylater.charge_type') == "percentage") {
                $service_fee['paylater_fee'] = floatval((config('payment.paylater.charge') / 100) * $amount);
            } else {
                $service_fee['paylater_fee'] = floatval(config('payment.paylater.charge'));
            }
        }
        if (config('payment.ok.enable') == "true") {
            if (config('payment.ok.charge_type') == "percentage") {
                $service_fee['ok_fee'] = floatval((config('payment.ok.charge') / 100) * $amount);
            } else {
                $service_fee['ok_fee'] = floatval(config('payment.ok.charge'));
            }
        }
        if (config('payment.paypal.enable') == "true") {
            if (config('payment.paypal.charge_type') == "percentage") {
                $service_fee['paypal_fee'] = floatval((config('payment.paypal.charge') / 100) * $amount);
            } else {
                $service_fee['paypal_fee'] = floatval(config('payment.paypal.charge'));
            }
        }

        if (config('payment.mpu.enable') == "true") {
            if (config('payment.mpu.charge_type') == "percentage") {
                $service_fee['mpu_fee'] = floatval((config('payment.mpu.charge') / 100) * $amount);
            } else {
                $service_fee['mpu_fee'] = floatval(config('payment.mpu.charge'));
            }
        }

        if (config('payment.transfer.enable') == "true") {
            if (config('payment.transfer.charge_type') == "percentage") {
                $service_fee['transfer_fee'] = floatval((config('payment.transfer.charge') / 100) * $amount);
            } else {
                $service_fee['transfer_fee'] = floatval(config('payment.transfer.charge'));
            }
        }

        if (config('payment.visa_master.enable') == "true") {
            if (config('payment.visa_master.charge_type') == "percentage") {
                $service_fee['visa_master_fee'] = floatval((config('payment.visa_master.charge') / 100) * $amount);
            } else {
                $service_fee['visa_master_fee'] = floatval(config('payment.visa_master.charge'));
            }
        }

        if (config('payment.mab.enable') == "true") {
            if (config('payment.mab.charge_type') == "percentage") {
                $service_fee['mab_fee'] = floatval((config('payment.mab.charge') / 100) * $amount);
            } else {
                $service_fee['mab_fee'] = floatval(config('payment.mab.charge'));
            }
        }

        if (config('payment.onetwothree.enable') == "true") {
            if (config('payment.onetwothree.charge_type') == "percentage") {
                $service_fee['onetwothree_fee'] = floatval((config('payment.onetwothree.charge') / 100) * $amount);
            } else {
                $service_fee['onetwothree_fee'] = floatval(config('payment.onetwothree.charge'));
            }
        }

        if (config('payment.truemoney.enable') == "true") {
            if (config('payment.truemoney.charge_type') == "percentage") {
                $service_fee['truemoney_fee'] = floatval((config('payment.truemoney.charge') / 100) * $amount);
            } else {
                $service_fee['truemoney_fee'] = floatval(config('payment.truemoney.charge'));
            }
        }

        if (config('payment.deposite.enable') == "true") {
            if (config('payment.deposite.charge_type') == "percentage") {
                $service_fee['deposite_fee'] = floatval((config('payment.deposite.charge') / 100) * $amount);
            } else {
                $service_fee['deposite_fee'] = floatval(config('payment.deposite.charge'));
            }
        }
        return $service_fee;
    }

                    // PAYMENT 
    public function transfer($encrypt_booking_id, $total_amount)
    {
        $booking_id = HotelEncryption::decode($encrypt_booking_id);
        $booking = Booking::find($booking_id);
        $form['url'] = url('booking/payment_complete/transfer/' . $encrypt_booking_id);
        $form['values'] = '
                        <legend> Bank Transfer Informations :  </legend>
                             
                             <span style="color:red;" >' . trans('frontend.transfer_info') . '</span><br>
                             <br>
                             <span style="color:red;margin-top:15px;" >
                             
                             ' . trans('frontend.bank_transfer') . ' Amount      - ' . $total_amount . ' MMK <br>
                             Payment Description  - Payment for Ticket No. ' . $booking->booking_ref . '
                             </span>
                            <input type="hidden" name="booking_ref" value="' . $booking->booking_ref . '"> 
                            <div class="control-group" >
                                <label class="control-label">' . trans('frontend.bank_transfer') . '</label>
                                <div class="controls">
                                         <select class="form-control" name="bank_name">';

        if (config('payment.transfer.transfer_1')) {
            $form['values'] .= '<option value="' . config('payment.transfer.transfer_1') . '">' . config('payment.transfer.transfer_1') . '</option>';
        }
        if (config('payment.transfer.transfer_2')) {
            $form['values'] .= '<option value="' . config('payment.transfer.transfer_2') . '">' . config('payment.transfer.transfer_2') . '</option>';
        }
        if (config('payment.transfer.transfer_3')) {
            $form['values'] .= '<option value="' . config('payment.transfer.transfer_3') . '">' . config('payment.transfer.transfer_3') . '</option>';
        }
        if (config('payment.transfer.transfer_4')) {
            $form['values'] .= '<option value="' . config('payment.transfer.transfer_4') . '">' . config('payment.transfer.transfer_4') . '</option>';
        }
        if (config('payment.transfer.transfer_5')) {
            $form['values'] .= '<option value="' . config('payment.transfer.transfer_5') . '">' . config('payment.transfer.transfer_5') . '</option>';
        }
        if (config('payment.transfer.transfer_6')) {
            $form['values'] .= '<option value="' . config('payment.transfer.transfer_6') . '">' . config('payment.transfer.transfer_6') . '</option>';
        }
        if (config('payment.transfer.transfer_7')) {
            $form['values'] .= '<option value="' . config('payment.transfer.transfer_7') . '">' . config('payment.transfer.transfer_7') . '</option>';
        }
        if (config('payment.transfer.transfer_8')) {
            $form['values'] .= '<option value="' . config('payment.transfer.transfer_8') . '">' . config('payment.transfer.transfer_8') . '</option>';
        }
        if (config('payment.transfer.transfer_9')) {
            $form['values'] .= '<option value="' . config('payment.transfer.transfer_9') . '">' . config('payment.transfer.transfer_9') . '</option>';
        }
        if (config('payment.transfer.transfer_10')) {
            $form['values'] .= '<option value="' . config('payment.transfer.transfer_10') . '">' . config('payment.transfer.transfer_10') . '</option>';
        }

        $form['values'] .= '</select>
                                </div>
                            </div>

                            <div class="control-group" >
                                <label class="control-label">' . trans('frontend.remark') . '</label>
                                <div class="controls">
                                    <textarea class="form-control" name="remark" placeholder="Optional" ></textarea>
                                </div>
                            </div>';
        return $form;
    }

    // public function truemoney($encrypt_booking_id, $total_amount)
    // {
    //     $booking_id = BNFEncryption::decode($encrypt_booking_id);
    //     $booking = Booking::with('room','hotels','hotels.city')->where('id', $booking_id)->first();


    //     $data = array(
    //         0 => $booking->id,
    //         1 => $booking->amount,
    //         2 => date('Y-m-d', strtotime($booking->created_at)),
    //         3 => $booking->booking_expire,
    //         4 => $booking->htoels->city->name,
    //         5 => date('Y-m-d', strtotime($booking->check_in_date)),
    //         6 => $booking->check_out_date,
    //         7 => $$booking->hotels->name,
    //         8 => $booking->hotels->class,
    //         9 => $booking->room->name : '',
    //         10 => $booking->quantity,
    //         11 => $booking->check_in_name,
    //         12 => 0,
    //         13 => 0,
    //         14 => 0,
    //         15 => 0
    //     );

    //     $sorted_data = implode('', $data);//combine array as a string

    //     $hashValue = hash_hmac('sha1', $sorted_data, config('payment.truemoney.hash_key'));

    //     $request = config('payment.truemoney.url') . '/' . config('payment.truemoney.merchant_id') . '?';

    //     $params = array(
    //         'bookingId' => $booking->id,
    //         'amount' => $booking->amount,
    //         'bookingdate' => date('Y-m-d', strtotime($booking->created_at)),
    //         'expirydate' => $booking->booking_expire,
    //         'city' => $booking->htoels->city->name,
    //         'check_in_date' => date('Y-m-d', strtotime($booking->check_in_date)),
    //         'check_out_date' => $booking->check_out_date,
    //         'hotel' => $$booking->hotels->name,
    //         'hotelclass' => $booking->hotels->class,
    //         'rooms' => $booking->room->name,
    //         'quantity' => $booking->quantity,
    //         'customer1' => $booking->check_in_name,
    //         'customer2' => 0,
    //         'customer3' => 0,
    //         'customer4' => 0,
    //         'hashvalue' => $hashValue
    //     );

    //     $request .= http_build_query($params);
    //     $request = str_replace('+', '%20', $request);

    //     try {

    //         $curl = curl_init();

    //         curl_setopt_array($curl, array(
    //             CURLOPT_PORT => "8786",
    //             CURLOPT_URL => $request,
    //             CURLOPT_RETURNTRANSFER => true,
    //             CURLOPT_ENCODING => "",
    //             CURLOPT_MAXREDIRS => 10,
    //             CURLOPT_TIMEOUT => 30,
    //             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //             CURLOPT_CUSTOMREQUEST => "POST",
    //             CURLOPT_HTTPHEADER => array(
    //                 "cache-control: no-cache"
    //             ),
    //         ));

    //         $response = curl_exec($curl);
    //         $err = curl_error($curl);

    //         curl_close($curl);

    //         $response = json_decode($response);

    //         if (Payment::where('booking_id', $response->bookingId)->count()) {
    //             $payment = Payment::where('booking_id', $response->bookingId)->first();
    //         } else {
    //             $payment = new Payment;
    //         }

    //         $payment->booking_id = $booking_id;
    //         $payment->method = 'truemoney';
    //         $payment->info = json_encode($response);

    //         $payment->save();

    //         $message = \App\Models\Sms::get('truemoney_pay',$booking->language)->content;

    //         $message = str_replace('{NAME}',$booking->guest_name, $message);
    //         $message = str_replace('{CODE}',$response->tmmRefNo, $message);
    //         $message = str_replace('{NEWLINE}',PHP_EOL, $message);

    //         $class = 1;
    //         $priority = 6;
    //         $description = 'Send True Money E-email!';

    //         $res['method'] = 'truemoney';
    //         $res['data'] = $response;

    //         return $res;
    //     } catch (Exception $e) {

    //         throw new Exception("Error Processing Request", 1);

    //     }
    // }

    public function visa_master($encrypt_booking_id, $total_amount)
    {
        $booking_id = HotelEncryption::decode($encrypt_booking_id);
        $booking = Booking::find($booking_id);

        $real_amount = sprintf("%.2f", $total_amount);
        $amount = str_replace('.', '', $real_amount);

        $amount = str_pad($amount, 12, '0', STR_PAD_LEFT);
        $payment_description = app_name() . ' ref: ' . $booking->booking_ref;
        $TransactionID = $booking_id . date('dmy');
        $result_url_1 = url("/booking/payment_complete/visa_master");
        $result_url_2 = url("/booking/payment_status/visa_master");

        $strSignatureString = config('payment.visa_master.version')
            . config('payment.visa_master.merchant_id')
            . $payment_description . $TransactionID . $booking->ref
            . config('payment.visa_master.currency') . $amount . $booking->guest_email
            . $encrypt_booking_id . $booking->ref.$result_url_1.$result_url_2;

        $HashValue = hash_hmac('sha1', $strSignatureString, config('payment.visa_master.hash_key'), false);

        $form['url'] = config('payment.visa_master.payment_url');
        $form['values'] =
            '<input type="hidden" id="version" name="version" value="' . config('payment.visa_master.version') . '" >' .
            '<input type="hidden" id="merchant_id" name="merchant_id" value="' . config('payment.visa_master.merchant_id') . '" >' .
            '<input type="hidden" id="payment_description" name="payment_description" value="' . $payment_description . '" >' .
            '<input type="hidden" id="order_id" name="order_id" value="' . $TransactionID . '">' .
            '<input type="hidden" id="invoice_no" name="invoice_no" value="' . $booking->ref . '" >' .
            '<input type="hidden" id="currency" name="currency" value="' . config('payment.visa_master.currency') . '" >' .
            '<input type="hidden" id="amount" name="amount" value="' . $amount . '" >' .
            '<input type="hidden" id="customer_email" name="customer_email" value="' . $booking->guest_email . '" >' .
            '<input type="hidden" id="user_defined_1" name="user_defined_1" value="' . $encrypt_booking_id . '" >' .
            "<input type='hidden' id='result_url_1' name='result_url_1' value='" .$result_url_1. "'/>".
            "<input type='hidden' id='result_url_2' name='result_url_2' value='" .$result_url_2. "'/>".
            '<input type="hidden" id="user_defined_2" name="user_defined_2" value="' . $booking->ref . '" >' .
            '<input type="hidden" id="hash_value" name="hash_value" value="' . $HashValue . '" >';

        return $form;
    }

     public function mab($encrypt_booking_id, $total_amount)
    {
        $booking_id = HotelEncryption::decode($encrypt_booking_id);
        $booking = Booking::with('hotels','room')->where('id', $booking_id)->first();

        $sOID = $booking->booking_ref;
        if ($booking->type == 'local') {
            $price = $booking->room->local_sell_price;
        } else {
            $price = $booking->room->foreign_sell_price;
        }

        $message = array();
        $message["items"][0]["Name"] = $booking->check_in_name;
        $message["items"][0]["Qty"] = $booking->qty;
        $message["items"][0]["Price"] = $price;
        $message["items"][0]["Amount"] = $total_amount;
        $message["Quantity"] = $booking->quantity;
        $message["TotalPrice"] = $total_amount;
        $message["TotalDiscount"] = $booking->discount;
        $message["PayAmount"] = $total_amount;
        $message = json_encode($message);
        $summery = "Buying room ticket(s) at ".app_name().".";
        $mac = HotelEncryption::mab_mac_hash($sOID, $total_amount, $summery);

        $form['url'] = config('payment.mab.url');
        $form['values'] = '
                    <input type="hidden" id="MID" name="MID" value="' . config('payment.mab.MID') . '"/> 
                    <input type="hidden" id="MName" name="MName" value="' . config('payment.mab.MName') . '"/> 
                    <input type="hidden" id="OID" name="OID" value="' . $booking->booking_ref . '"/> 
                    <input type="hidden" id="Amount" name="Amount" value="' . $total_amount . '"/>
                    <input type="hidden" id="Description" name="Description" value="' . htmlentities($message) . '"/> 
                    <input type="hidden" name="Summary" value="' . $summery . '" />
                    <input type="hidden" name="Timeout" value="00000600" /> 
                    <input type="hidden" name="RequestDate" value="' . date('YmdHis') . '" />
                    <input type="hidden" name="MAC" value="' . $mac . '" />
                    <input type="hidden" name="CallbackURL" value="' . url('booking/payment_complete/mab/' . $encrypt_booking_id) . '" />';

        return $form;
    }

     public function paypal($encrypt_booking_id, $total_amount)
    {
        $booking_id = HotelEncryption::decode($encrypt_booking_id);
        $booking = Booking::find($booking_id);

        $form['url'] = config('payment.paypal.payment_url');
        $form['values'] = '<input type="hidden" value="_xclick" name="cmd" >' .
            '<input type="hidden" value="' . config('payment.paypal.email') . '" name="business" >' .
            '<input type="hidden" value="USD" name="currency_code" >' .
            '<input type="hidden" value="' . $total_amount . '" name="amount" >' .
            '<input type="hidden" value="' . app_name() . ' ref: ' . $booking->ref . '" name="item_name" >' .
            '<input type="hidden" value="' . url('booking/payment_complete/paypal/' . $encrypt_booking_id) . '" name="return" >';

        return $form;
    }

   public function mpu($encrypt_booking_id, $total_amount)
    {
        $booking_id = HotelEncryption::decode($encrypt_booking_id);
        $booking = Booking::find($booking_id);

        $amount = $total_amount . "00";

        $amount = str_pad($amount, 12, '0', STR_PAD_LEFT);

        $secretKey = config('payment.mpu.hash_key');   //Get SecretKey from 2C2P Merchant Interface

        $version = config('payment.mpu.version');
        $merchant_id = config('payment.mpu.merchant_id');
        $payment_description = app_name() . ' ref: ' . $booking->ref;
        $order_id = str_pad($booking->id, 20, '0', STR_PAD_LEFT);
        $invoice_no = $booking->booking_ref;
        $currency = "104";
        $customer_email = "";
        $pay_category_id = "";
        $promotion = "";
        $user_defined_1 = $encrypt_booking_id;
        $user_defined_2 = "booking";
        $user_defined_3 = "";
        $user_defined_4 = "";
        $user_defined_5 = "";
        $result_url_1 = url("/booking/payment_complete/mpu");
        $result_url_2 = url("/booking/payment_status/mpu");
        $request_3ds = "";
        $stringToHash = $version . $merchant_id . $payment_description . $order_id . $invoice_no . $currency . $amount . $customer_email . $pay_category_id . $promotion . $user_defined_1 . $user_defined_2 . $user_defined_3 . $user_defined_4 . $user_defined_5 . $result_url_1 . $result_url_2 . $request_3ds ;
        $hash = strtoupper(hash_hmac('sha1', $stringToHash ,$secretKey, false));

        $form['url'] = config('payment.mpu.payment_url');
        $form['values'] =
              "<input type='hidden' id='version' name='version' value='" .$version. "'/>".
              "<input type='hidden' id='merchant_id' name='merchant_id' value='" .$merchant_id. "'/>".
              "<input type='hidden' id='payment_description' name='payment_description' value='" .$payment_description. "' /> ".
              "<input type='hidden' id='order_id' name='order_id' value='" .$order_id. "' />    ".                    
              "<input type='hidden' id='invoice_no' name='invoice_no' value='" .$invoice_no. "' />".
              "<input type='hidden' id='currency' name='currency' value='" .$currency. "'/>".
              "<input type='hidden' id='amount' name='amount' value='" .$amount. "'/>".
              "<input type='hidden' id='customer_email' name='customer_email' value='" .$customer_email. "'/>".
              "<input type='hidden' id='pay_category_id' name='pay_category_id' value='" .$pay_category_id. "'/>".
              "<input type='hidden' id='promotion' name='promotion' value='" .$promotion. "'/>".
              "<input type='hidden' id='user_defined_1' name='user_defined_1' value='" .$user_defined_1. "'/>".
              "<input type='hidden' id='user_defined_2' name='user_defined_2' value='" .$user_defined_2. "'/>".
              "<input type='hidden' id='user_defined_3' name='user_defined_3' value='" .$user_defined_3. "'/>".
              "<input type='hidden' id='user_defined_4' name='user_defined_4' value='" .$user_defined_4. "'/>".
              "<input type='hidden' id='user_defined_5' name='user_defined_5' value='" .$user_defined_5. "'/>".
              "<input type='hidden' id='result_url_1' name='result_url_1' value='" .$result_url_1. "'/>".
              "<input type='hidden' id='result_url_2' name='result_url_2' value='" .$result_url_2. "'/>".
              "<input type='hidden' id='request_3ds' name='request_3ds' value='" .$request_3ds. "'/>".
              "<input type='hidden' id='hash_value' name='hash_value' value='" .$hash. "'/>";

        return $form;
    }

   public function save_transfer($encrypt_booking_id, $input)
    {
        $booking_id = HotelEncryption::decode($encrypt_booking_id);
        $booking = Booking::find($booking_id);
        $booking->bank_name = $input['bank_name'];
        $booking->bank_remark = $input['remark'];
        $booking->save();
        $response['amount'] = $booking->amount;
        $response['ref'] = $booking->booking_ref;
        $response['bank_name'] = $booking->bank_name;
        $response['bank_remark'] = $booking->bank_remark;

        return $response;
    }

// public function save_truemoney($encrypt_booking_id, $input)
//     {
//         $booking_id = HotelEncryption::decode($encrypt_booking_id);
//         $booking = Booking::find($booking_id);

//         if (Payment::where('booking_id', $booking_id)->count() && $input['status'] == 'Paid') {

//             $payment = Payment::where('booking_id', $booking_id)->first();
//             $payment->booking_id = $booking_id;
//             $payment->method = 'truemoney';
//             $payment->info = json_encode($input);
//             $payment->save();

//             $booking = Booking::find($booking_id);
//             $booking->payment_complete = 1;
//             $booking->save();
            //$this->sent_final_ticket($booking->id);


    //     }
    //     return true;
    // }

    public function save_visa_master($encrypt_booking_id, $input)
    {
        $booking_id = HotelEncryption::decode($encrypt_booking_id);
        $booking = Booking::find($booking_id);

        $ref = @$input["user_defined_2"];
        $channel_response_code = @$input["channel_response_code"];
        $channel_response_desc = @$input["channel_response_desc"];

        
         if ($channel_response_code === '00' && Payment::where('booking_id', $booking_id)->count()) {

            $payment = Payment::where('booking_id', $booking_id)->first();
            $payment->booking_id = $booking_id;
            $payment->method = 'visa_master';
            $payment->info = json_encode($input);
            $payment->save();

            $booking = Booking::find($booking_id);
            $booking->payment_complete = 1;
            $booking->save();

            // $this->sent_final_ticket($booking->id);

            $response['paid'] = true;

        } elseif ($channel_response_code === '00' && Booking::where('id', $booking_id)->count()) {

            $payment = new Payment;
            $payment->booking_id = $booking_id;
            $payment->method = 'visa_master';
            $payment->info = json_encode($input);
            $payment->save();

            $booking = Booking::find($booking_id);
            $booking->payment_complete = 1;
            $booking->save();
            //$this->sent_final_ticket($booking->id);


            $response['paid'] = true;
            
        } else {

            $response['paid'] = false;
            $response['message'] = $channel_response_desc;
        }
        $response['ref'] = $ref;

        return $response;
    }

     public function save_mab($encrypt_booking_id, $input)
    {
        $booking_id = HotelEncryption::decode($encrypt_booking_id);
        $booking = Booking::find($booking_id);
        $ref = $booking->booking_ref;
        $StatusCode = $input['StatusCode'];
        $ErrorMessage = $input['ErrorMessage'];

       
        if ($StatusCode == '0020' && Payment::where('booking_id', $booking_id)->count()) {

            $payment = Payment::where('booking_id', $booking_id)->first();
            $payment->booking_id = $booking_id;
            $payment->method = 'mab';
            $payment->info = json_encode($input);
            $payment->save();

            $booking = Booking::find($booking_id);
            $booking->payment_complete = 1;
            $booking->save();
            //$this->sent_final_ticket($booking->id);

            $response['paid'] = true;

        } elseif ($StatusCode == '0020' && Booking::where('id', $booking_id)->count()) {

            $payment = new Payment;
            $payment->booking_id = $booking_id;
            $payment->method = 'mab';
            $payment->info = json_encode($input);
            $payment->save();

            $booking = Booking::find($booking_id);
            $booking->payment_complete = 1;
            $booking->save();
            //$this->sent_final_ticket($booking->id);

            $response['paid'] = true;

        } else {

            $response['paid'] = false;
            $response['message'] = $ErrorMessage;
        }
        $response['ref'] = $ref;

        return $response;
    }

    public function save_paypal($encrypt_booking_id, $input)
    {
        $booking_id = HotelEncryption::decode($encrypt_booking_id);
        $booking = Booking::find($booking_id);
        $ref = $booking->booking_ref;

       if (Payment::where('booking_id', $booking_id)->count()) {

            $payment = Payment::where('booking_id', $booking_id)->first();
            $payment->booking_id = $booking_id;
            $payment->method = 'paypal';
            $payment->info = json_encode($input);
            $payment->save();

            $booking = Booking::find($booking_id);
            $booking->payment_complete = 1;
            $booking->save();
            //$this->sent_final_ticket($booking->id);


            $response['paid'] = true;

        } elseif (Booking::where('id', $booking_id)->count()) {

            $payment = new Payment;
            $payment->booking_id = $booking_id;
            $payment->method = 'paypal';
            $payment->info = json_encode($input);
            $payment->save();

            $booking = Booking::find($booking_id);
            $booking->payment_complete = 1;
            $booking->save();
            //$this->sent_final_ticket($booking->id);

            $response['paid'] = true;

        } else {

            $response['paid'] = false;
            $response['message'] = 'failed';
        }
        $response['ref'] = $ref;

        return $response;
    }
    public function save_mpu($encrypt_booking_id, $input)
    {
        $booking_id = HotelEncryption::decode($encrypt_booking_id);
        $booking = Booking::find($booking_id);

        $status = @$input["status"];

        $ref = $booking->booking_ref;

        $channel_response_code = @$input["channel_response_code"];
        $channel_response_desc = @$input["channel_response_desc"];

        if($channel_response_code == '00' && Payment::where('booking_id', $booking_id)->count()) {

            $payment = Payment::where('booking_id', $booking_id);
            $payment->booking_id = $booking_id;
            $payment->method = 'mpu';
            $payment->info = json_encode($input);
            $payment->save();

            $booking = Booking::find($booking_id);
            $booking->payment_complete = 1;
            $booking->save();
            $this->sent_final_ticket($booking->id);

            if ($booking->parent_id) {
                $booking = Booking::find($booking->parent_id);
                $booking->payment_complete = 1;
                $booking->save();
                $this->sent_final_ticket($booking->id);
            }

            $response['paid'] = true;

        } elseif ($channel_response_code == '00' && Booking::where('id', $booking_id)->count()) {

            $payment = new Payment;
            $payment->booking_id = $booking_id;
            $payment->method = 'mpu';
            $payment->info = json_encode($input);
            $payment->save();

            $booking = Booking::find($booking_id);
            $booking->payment_complete = 1;
            $booking->save();
            $this->sent_final_ticket($booking->id);

            if ($booking->parent_id) {
                $booking = Booking::find($booking->parent_id);
                $booking->payment_complete = 1;
                $booking->save();
                $this->sent_final_ticket($booking->id);
            }

            $response['paid'] = true;
        } else {

            $response['paid'] = false;
            $response['message'] = $channel_response_desc;
        }
        $response['ref'] = $ref;

        return $response;
    }

}
?>
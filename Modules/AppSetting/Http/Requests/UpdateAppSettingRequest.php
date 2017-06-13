<?php

namespace Modules\AppSetting\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppSettingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        
        $tab=$this->tab;
        
        if($tab == 'basic')
      {  
        return [

            'app_name'=>'required',
            'appstore'=>'required',
            'playstore'=>'required',
            'facebook'=>'required',
            'googleplus'=>'required',
            'app_email'=>'required',
            'ticket_email'=>'required',
            'app_phone'=>'required',
            'app_address'=>'required', 
            'app_tnc'=>'required',
            'app_ref'=>'required',
            'app_dollar_rate'=>'required',
            'google_map'=>'required',


        ];
      }

      elseif($tab == 'theme')
      {
        return [

            'app_color'=>'required',
            'app_font_color'=>'required',
            'app_border_color'=>'required',
        ];
      }

      elseif($tab == 'booking')
      {
        return [

            'max_adult'=>'required',
            'before_block_min'=>'required',
            'room_hold_min'=>'required',
            'refund_coupon_expiry_min'=>'required',
            'booking_email'=>'required',
            'all_booking_expiry_min'=>'required',
            'reseller_default_margin'=>'required',
        ];

      }

      elseif($tab == 'payment')
      {

        return [

            'paylater_expiry'=>'required',             
            'paylater_charge'=>'required',

            'ok_apikey'=>'required',
            'ok_destination'=>'required',
            'ok_merchant_name'=>'required',
            'ok_payment_url'=>'required',
            'ok_charge'=>'required',

            'paypal_payment_url'=>'required',
            'paypal_email'=>'required',
            'paypal_charge'=>'required',

            'mpu_merchant_id'=>'required',
            'mpu_payment_url'=>'required',
            'mpu_hash_key'=>'required',
            'mpu_charge'=>'required',


            'true_hash_key'=>'required',
            'true_merchant_id'=>'required',
            'true_payment_url'=>'required',
            'true_charge'=>'required',

            'transfer_1'=>'required',
            'transfer_2'=>'required',
            'transfer_3'=>'required',
            'transfer_4'=>'required',
            'transfer_5'=>'required',
            'transfer_charge'=>'required',


            'onetwothree_merchantid'=>'required',
            'onetwothree_merchantpassword'=>'required',
            'onetwothree_version'=>'required',
            'onetwothree_currencycode'=>'required',
            'onetwothree_agentcode'=>'required',
            'onetwothree_agentid'=>'required',
            'onetwothree_channelcode'=>'required',
            'onetwothree_apikey'=>'required',
            'onetwothree_url'=>'required',
            'onetwothree_charge'=>'required',

            'mab_mid'=>'required',
            'mab_sharekey'=>'required',
            'mab_mname'=>'required',
            'mab_url'=>'required',
            'mab_act_url'=>'required',
            'mab_charge'=>'required',

            'deposite_charge'=>'required',


       ];

      } 

      elseif($tab == 'email')
      {
        return [

            'sms_server'=>'required',
            'sms_token'=>'required',
            'mail_driver'=>'required',
            'mail_host'=>'required',
            'mail_port'=>'required',
            
        ];

      }  


    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}

<?php

namespace Modules\Booking\Repositories;

use Modules\Booking\Entities\BookingEmail;
use Modules\Booking\Entities\Booking;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BookingRepository.
 */
class BookingEmailRepository extends Repository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = BookingEmail::class;

    /**
     * @param string $order_by
     * @param string $sort
     *
     * @return mixed
     */

     public function create(array $input)
    {  
            
         return DB::transaction(function () use ($input) {
            $booking_email = self::MODEL;
            $booking_email=new $booking_email();
            $booking_email->member_id             = $input['member_id'];
            $booking_email->booking_id            = $input['booking_id'];
            $booking_email->status                = $input['status'];
            $booking_email->c_remark              = isset($input['c_remark']) ? $input['c_remark']:" ";
            $booking_email->voucher_no            = isset($input['voucher_no']) ? $input['voucher_no']:" ";
            $booking_email->sender_id             = $input['sender_id'];
            $booking_email->sender_name           = $input['sender_name'];
           
          
            
            if (parent::save($booking_email)) {
              
                return $booking_email;
         
            }

            throw new GeneralException(trans('hotel::exceptions.backend.hotel.create_error'));
        });

    }
}
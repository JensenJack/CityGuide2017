<?php

namespace Modules\Booking\Entities;

use Illuminate\Database\Eloquent\Model;

class BookingEmail extends Model
{
    protected $table = 'booking_email';

    protected $fillable = [ 'booking_id', 'member_id', 'status', 'c_remark', 'voucher_no', 'sender_id', 'sender_name' ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        if(access()->hasPermission('view-booking')){
            return '<a href="'.route('admin.booking.view_booking_email', $this->id).'" class="btn btn-xs btn-info"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View"></i></a> ';
        }
        return '';
    }
    
}

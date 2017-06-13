<?php

namespace Modules\Booking\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Hotel\Entities\Hotel;
use Modules\Room\Entities\Room;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;
    protected $table = 'booking';

    protected $fillable = ['member_id','hotel_id','room_id','guest_name','check_in_name','guest_email','guest_nrc','guest_phone','booking_ref', 'booking_expire', 'amount', 'discount', 'payment_method', 'payment_complete', 'language', 'status', 'remark', 'check_in_date', 'check_out_date', 'quantity','is_guest','service_fee','note','bank_name','bank_remark'];

    public function hotels()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id', 'id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function booking_payment()
    {
        return $this->hasOne(Payment::class , 'booking_id');
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if(access()->hasPermission('edit-booking')){
             return '<a href="'.route('admin.booking.edit', $this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.edit').'"></i></a> ';
        }
       return '';
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        if(access()->hasPermission('view-booking')){
            return '<a href="'.route('admin.booking.show', $this).'" class="btn btn-xs btn-info"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View"></i></a> ';
        }
        return '';
    }

    /**
     * @return string
    */
    public function getDeleteButtonAttribute()
    {
        if($this->payment_complete != 1)
        {
            if(access()->hasPermission('delete-booking'))
            {
                return '<a href="'.route('admin.booking.destroy', $this).'"
                    data-method="delete"
                    data-trans-button-cancel="'.trans('buttons.general.cancel').'"
                    data-trans-button-confirm="'.trans('buttons.general.crud.delete').'"
                    data-trans-title="'.trans('strings.backend.general.are_you_sure').'"
                    class="btn btn-xs btn-danger"><i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.delete').'"></i></a> ';
            }
        }
        
        return '';
    }

    /**
    * @return string
    */
    public function getRestoreButtonAttribute()
    {
        if (access()->hasPermission('restore-booking')) {
            return '<a href="' . route('admin.booking.booking_restore', $this->id) . '" class="btn btn-xs btn-info  tooltips" data-original-title="' . trans('buttons.general.crud.restore') . '" data-placement="top" data-toggle="tooltip"><i class="fa fa-refresh"></i></a> ';
        }

        return '';
    }

    /**
    * @return string
    */
    public function getForceDeleteButtonAttribute()
    {
        if (access()->hasPermission('forceDelete-booking')) {
            return '<a href="' . route('admin.booking.booking_forcedelete', $this->id) . '" 
                    data-method="delete"
                    data-trans-button-cancel="'.trans('buttons.general.cancel').'"
                    data-trans-button-confirm="'.trans('buttons.general.crud.delete').'"
                    data-trans-title="'.trans('strings.backend.general.are_you_sure').'"
                    class="btn btn-xs btn-danger"><i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.delete').'"></i></a> ';
        }

        return '';
    }

    public function getBookingPaymentInfoButtonAttribute()
    {
        return "<a href='#' data-id='". $this->id ."' 
        data-url='".route('admin.booking.booking_payment_info')."' data-type='".$this->payment_method."' 
        data-title='" . trans('booking::labels.backend.booking.table.show_payment_info') . "' 
        data-value='" . $this->ref . "' class='btn btn-xs yellow paymentInfo'><i class='fa fa-money' 
        data-toggle='tooltip' data-placement='top' title='". trans('booking::labels.backend.booking.table.show_payment_info') ."'></i></a> ";
        
    }

    /**
     * @return string
    */
    public function getChangePaymentButtonAttribute()
    {
        if (access()->allow('change-booking-payment')) {
            if($this->payment_complete == 0){
                return '<button type="button" data-url="' . route('admin.booking.change_payment', $this->id) . '" class="btn btn-xs btn-info paymentChange" rel="change_payment_paid-' . $this->b_ref . '">' . trans('booking::labels.backend.booking.table.paid') . '</button> ';
            }
            else{
                return '<button type="button" data-url="' . route('admin.booking.change_payment', $this->id) . '" class="btn btn-xs btn-danger tooltips paymentChange" rel="change_payment_paid-' . $this->b_ref . '">' . trans('booking::labels.backend.booking.table.unpaid') . '</button> ';
            }
        }
        return '';

    }

    /**
    * @return string
    */
    public function getBookingRemarkButtonAttribute()
    {
        if (access()->allow('view-booking')) {
            if (empty($this->remark)) {
                return '<button type="button" data-url="' . route('admin.booking.add_remark', $this->id) . '" class="btn btn-xs btn-danger tooltips addRemark" rel="' . $this->booking_ref . '" data-value="' . $this->remark . '" data-original-title="' . trans('booking::labels.backend.booking.table.change_remark') . '"><i class="fa fa-question-circle"></i></button> ';
            }
            return '<button type="button" data-url="' . route('admin.booking.add_remark', $this->id) . '" class="btn btn-xs btn-info tooltips addRemark" rel="' . $this->booking_ref . '" data-value="' . $this->remark . '" data-original-title="' . trans('booking::labels.backend.booking.table.remark') . '"><i class="fa fa-question-circle"></i></button> ';
        }
        return date('d/M/Y H:i:s', strtotime($this->booking_expire));

    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getBookingPaymentInfoButtonAttribute().$this->getDeleteButtonAttribute().$this->getChangePaymentButtonAttribute().$this->getBookingRemarkButtonAttribute();
        // return $this->getDeleteButtonAttribute().$this->getChangePaymentButtonAttribute().$this->getBookingRemarkButtonAttribute();
    }

    public function getDeleteRestoreAttribute()
    {
        return $this->getRestoreButtonAttribute().$this->getForceDeleteButtonAttribute();
    }
}

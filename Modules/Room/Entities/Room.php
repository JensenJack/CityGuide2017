<?php

namespace Modules\Room\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Hotel\Entities\Hotel;
use Modules\Booking\Entities\Booking;
use Modules\RoomCategory\Entities\RoomCategory;
use Modules\Amenity\Entities\Amenity;

class Room extends Model
{
    protected $table = 'room';

    protected $fillable = [
                'status','name','meta_keyword', 'meta_description', 'hotel_id', 'room_category_id', 'description', 'local_buy_price', 'local_sell_price', 'foreign_buy_price','foreign_sell_price', 'agent_buy_price', 'agent_sell_price', 'quantity', 'maximum_stay', 'max_adults', 'extra_bed', 'extra_bed_charge'
    ];

    protected $appends =['available_qty'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    public function room_amenities()
    {
        return $this->belongsToMany(Amenity::class, 'room_amenities');
    }

    public function room_category()
    {
        return $this->belongsTo(RoomCategory::class, 'room_category_id', 'id');
    }

    public function room_image()
    {
        return $this->hasMany(RoomImage::class, 'room_id');
    }

    public function getAvailableQtyAttribute()
    {
        $today = date("Y-m-d h:i:s");
        $booked_qty = Booking::where('room_id',$this->id)->where('check_out_date', '>', $today)->sum('quantity');
        return $this->quantity - $booked_qty;
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if(access()->hasPermission('edit-room')){
             return '<a href="'.route('admin.room.edit', $this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.edit').'"></i></a> ';
        }
       return '';
    }

    public function getUploadButtonAttribute()
    {
        if(access()->hasPermission('view-room')){
            return '<a href="'.route('admin.room.room_image_uploadform', $this).'" class="btn btn-xs btn-info"><i class="fa fa-upload" data-toggle="tooltip" data-placement="top" title="Upload Image"></i></a> ';
        }
        return '';
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        if(access()->hasPermission('view-room')){
            return '<a href="'.route('admin.room.show', $this).'" class="btn btn-xs btn-info"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View"></i></a> ';
        }
        return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if(access()->hasPermission('delete-room')){
            return '<a href="'.route('admin.room.destroy', $this).'"
                data-method="delete"
                data-trans-button-cancel="'.trans('buttons.general.cancel').'"
                data-trans-button-confirm="'.trans('buttons.general.crud.delete').'"
                data-trans-title="'.trans('strings.backend.general.are_you_sure').'"
                class="btn btn-xs btn-danger"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.delete').'"></i></a>';
        }
        return '';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
            return $this->getUploadButtonAttribute().$this->getShowButtonAttribute().$this->getEditButtonAttribute().$this->getDeleteButtonAttribute();
    }
}

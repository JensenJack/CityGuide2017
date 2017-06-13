<?php

namespace Modules\Amenity\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Hotel\Entities\Hotel;
use Modules\Hotel\Entities\Room;
use Modules\Hotel\Entities\HotelAmenity;

class Amenity extends Model
{
    protected $table = 'amenity';

    protected $fillable = ['name'];

    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'hotel_amenities');
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_amenities');
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
         if(access()->hasPermissions('edit-amenity'))
         {
        return '<a href="'.route('admin.amenity.edit', $this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.edit').'"></i></a> ';
         }
         return '';
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute()

    {
        if(access()->hasPermissions('view-amenity'))
        {
        return '<a href="'.route('admin.amenity.show', $this).'" class="btn btn-xs btn-info"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View"></i></a> ';
        }
        return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
            if(access()->hasPermissions('delete-amenity'))
            {
            return '<a href="'.route('admin.amenity.destroy', $this).'"
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
        
        return $this->getEditButtonAttribute().$this->getDeleteButtonAttribute();

    }
}

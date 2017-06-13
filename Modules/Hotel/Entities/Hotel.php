<?php

namespace Modules\Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\City\Entities\City;
use Modules\HotelCategory\Entities\HotelCategory;
use Modules\Hotel\Entities\HotelImage;
use Modules\Amenity\Entities\Amenity;

class Hotel extends Model
{
    protected $table = 'hotel';

    protected $fillable = [
        'name','meta_keyword', 'meta_description', 'address', 'latitude', 'longitude', 'logo', 'phone', 'email', 'description', 'class', 'city_id', 'hotel_category_id' 
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id','id');
    }

    public function hotel_category()
    {
        return $this->belongsTo(HotelCategory::class, 'hotel_category_id','id');
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class,'hotel_amenities');
    }

    public function hotel_image()
    {
        return $this->hasMany(HotelImage::class, 'hotel_id');
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if(access()->hasPermission('edit-hotel')){
             return '<a href="'.route('admin.hotel.edit', $this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.edit').'"></i></a> ';
        }
       return '';
    }

    public function getUploadButtonAttribute()
    {
        if(access()->hasPermission('view-hotel')){
            return '<a href="'.route('admin.hotel.hotel_image_uploadform', $this).'" class="btn btn-xs btn-info"><i class="fa fa-upload" data-toggle="tooltip" data-placement="top" title="Upload Image"></i></a> ';
        }
        return '';
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        if(access()->hasPermission('view-hotel')){
            return '<a href="'.route('admin.hotel.show', $this).'" class="btn btn-xs btn-info"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View"></i></a> ';
        }
        return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if(access()->hasPermission('delete-hotel')){
            return '<a href="'.route('admin.hotel.destroy', $this).'"
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

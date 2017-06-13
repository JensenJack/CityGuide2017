<?php

namespace Modules\HotelSupplier\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HotelSupplier\Entities\HotelSupplier;
use Modules\Hotel\Entities\Hotel;
use App\Models\Access\User\User;

class HotelSupplier extends Model
{
    protected $table = 'hotel_supplier';

    protected $fillable = ['hotel_id','supplier_id'];

    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_id');
    }
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if(access()->hasPermission('edit-hotelsupplier')){
             return '<a href="'.route('admin.hotelsupplier.edit', $this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.edit').'"></i></a> ';
        }
       return '';
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        if(access()->hasPermission('view-hotelsupplier')){
            return '<a href="'.route('admin.hotelsupplier.show', $this).'" class="btn btn-xs btn-info"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View"></i></a> ';
        }
        return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if(access()->hasPermission('delete-hotelsupplier')){
            return '<a href="'.route('admin.hotelsupplier.destroy', $this).'"
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

    public function getHotelNameAttribute()
    {
        $un_hotel_id = unserialize($this->hotel_id);
        $hotel_names = Hotel::whereIn('id', $un_hotel_id)->pluck('name','id');
        $names='';
        foreach($hotel_names as $key=>$hotel_name){
            $names .= '<a href="'.route('admin.hotel.show', $key).'" class="btn btn-info">' . $hotel_name . '</a> ';
        }
        return $names;
    }
}

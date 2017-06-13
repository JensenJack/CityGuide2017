<?php

namespace Modules\HotelCategory\Entities;

use Illuminate\Database\Eloquent\Model;

class HotelCategory extends Model
{
    protected $table = 'hotelcategory';

    protected $fillable = ['name','description'];

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
         if(access()->hasPermissions('edit-hotelcategory'))
         {
        return '<a href="'.route('admin.hotelcategory.edit', $this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.edit').'"></i></a> ';
         }
         return '';
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute()

    {
        if(access()->hasPermissions('view-hotelcategory'))
        {
        return '<a href="'.route('admin.hotelcategory.show', $this).'" class="btn btn-xs btn-info"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View"></i></a> ';
        }
        return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
            if(access()->hasPermissions('delete-hotelcategory'))
            {
            return '<a href="'.route('admin.hotelcategory.destroy', $this).'"
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

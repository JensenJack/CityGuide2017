<?php

namespace Modules\City\Entities;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'city';

    protected $fillable = ['name', 'meta_keyword', 'meta_description','longitude','latitude'];

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
         if(access()->hasPermissions('edit-city'))
         {
        return '<a href="'.route('admin.city.edit', $this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.edit').'"></i></a> ';
         }
         return '';
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute()

    {
        if(access()->hasPermissions('view-city'))
        {
        return '<a href="'.route('admin.city.show', $this).'" class="btn btn-xs btn-info"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View"></i></a> ';
        }
        return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
            if(access()->hasPermissions('delete-city'))
            {
            return '<a href="'.route('admin.city.destroy', $this).'"
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

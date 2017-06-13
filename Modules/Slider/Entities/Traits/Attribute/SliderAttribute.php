<?php

namespace Modules\Slider\Entities\Traits\Attribute;

/**
 * Class SliderAttribute.
 */
trait SliderAttribute
{

    public function getPhotoImageAttribute()
    {
        return url('storage/'.$this->photo);
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
            return '<a href="'.route('admin.slider.destroy', $this).'"
                data-method="delete"
                data-trans-button-cancel="'.trans('buttons.general.cancel').'"
                data-trans-button-confirm="'.trans('buttons.general.crud.delete').'"
                data-trans-title="'.trans('strings.backend.general.are_you_sure').'"
                class="btn btn-xs btn-danger"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.delete').'"></i></a>';

    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getDeleteButtonAttribute();
    }
}

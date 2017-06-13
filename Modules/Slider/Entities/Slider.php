<?php

namespace Modules\Slider\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Slider\Entities\Traits\Attribute\SliderAttribute;

class Slider extends Model
{
	use SliderAttribute;

    protected $fillable = ['photo','description'];

    protected $appends = ['photo_image'];
}

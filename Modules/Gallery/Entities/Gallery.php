<?php

namespace Modules\Gallery\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Gallery\Entities\Traits\Attribute\GalleryAttribute;

class Gallery extends Model
{
	use GalleryAttribute;

    protected $fillable = ['category_id','name','type','url'];

}

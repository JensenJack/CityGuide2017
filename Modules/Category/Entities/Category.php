<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Traits\Attribute\CategoryAttribute;

class Category extends Model
{
	use CategoryAttribute;

    protected $fillable = ['name','description'];

}

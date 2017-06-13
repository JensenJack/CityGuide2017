<?php

namespace Modules\Email\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Email\Entities\Traits\Attribute\EmailAttribute;

class Email extends Model
{
	use EmailAttribute;
    protected $fillable = ['slug','ledgen','subject','content','mm_subject','mm_content'];
    protected $table='email';
 }

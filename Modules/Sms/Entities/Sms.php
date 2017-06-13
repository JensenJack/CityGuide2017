<?php

namespace Modules\Sms\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Sms\Entities\Traits\Attribute\SmsAttribute;

class Sms extends Model
{
	use SmsAttribute;
    protected $fillable = ['slug', 'ledgen', 'content', 'mm_content'];
    protected $table = 'sms';
}

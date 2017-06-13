<?php

namespace Modules\Booking\Entities;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = ['booking_id','method','info'];


}

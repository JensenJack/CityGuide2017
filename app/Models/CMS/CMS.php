<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CMS extends Model
{
    use SoftDeletes;

    protected $table='cms';

    protected $guarded = 'id';

    protected $fillable = [
        'meta_tags','keyword','page','title','content','mm_title','mm_content'
    ];

    // to set table name to dynamic
    // public function __construct(array $attributes = [])
    // {
    //     parent::__construct($attributes);
    //     $this->table = config('module.table.cms_page');
    // }
}

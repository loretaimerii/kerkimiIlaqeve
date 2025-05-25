<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ilaqet extends Model
{
    //
    protected $table = 'ilaqet';
    protected $fillable=['ndc_code','brand_name','generic_name','labeler_name','product_type'];
}

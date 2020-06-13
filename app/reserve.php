<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class reserve extends Model
{
    //
    protected $guarded=[];
    use SoftDeletes;
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class dayFood extends Model
{
    //
    protected $guarded=[];
    use SoftDeletes;
}

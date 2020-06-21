<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class dayFood extends Model
{
    //
    protected $guarded = [];
    use SoftDeletes;

    public function food()
    {
        return $this->hasOne('App\foodList', 'id', 'food_id');

    }
}

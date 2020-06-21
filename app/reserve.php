<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class reserve extends Model
{
    //
    protected $guarded = [];
    use SoftDeletes;

    public function foodDay()
    {
        return $this->hasOne('App\dayFood', 'id', 'dayFood_id')->with('food');
    }

    public function users()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}

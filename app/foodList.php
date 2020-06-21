<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class foodList extends Model
{
    //
    protected $guarded = [];
    use SoftDeletes;

    public static function list($status = 'all')
    {
        if ($status == 'all') {
            $lists = foodList::all();
        } elseif($status=='active') {
            $lists = foodList::where('status', 1)->get();
        } elseif($status=='inactive') {
            $lists = foodList::where('status', 0)->get();
        }
        return $lists->map(function ($lists) {
            $status = 'فعال';
            if ($lists['status'] == 0) {
                $status = 'غیر فعال';
            }
            return [
                'id' => $lists['id'],
                'title' => $lists['title'],
                'status' => $status,
                'price' => number_format($lists['price']),
                'description' => $lists->description
            ];
        });
    }
}

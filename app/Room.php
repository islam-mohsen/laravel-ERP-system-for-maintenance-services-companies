<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes;

    //
    public static function deleteRoom($id)
    {
        return Room::find($id)->delete();
    }

    public function stores()
    {
        return $this->belongsTo(\App\Store::class);
    }

}

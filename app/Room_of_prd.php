<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room_of_prd extends Model
{
    use SoftDeletes;

    //

    public function prds()
    {
        return $this->hasOne(\App\Product::class, 'id', 'part_num_id');
    }

    public function room()
    {
        return $this->belongsTo(\App\Room::class);
    }

    public static function deleteRoomOfPrd($id)
    {
        return Room_of_prd::find($id)->delete();
    }
    protected $fillable = [
        'room_id',
        'quantity',

        // add all other fields
    ];
}

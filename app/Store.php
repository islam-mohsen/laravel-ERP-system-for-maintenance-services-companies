<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Roome;

class Store extends Model
{
    //
    use SoftDeletes;

    //
    public static function deleteStore($id)
    {
        Room::where('store_id', $id)->delete();
        return Store::find($id)->delete();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use SoftDeletes;

    public function prds()
    {
        return $this->hasOne(\App\Product::class, 'id', 'prt_num_id'); //prt_num_id -- part_num_id
    }

    public function store($prt_num_id, $actions, $come, $leave, $count_of, $price,$customer,$supplier, $date)
    {
        //`prt_num_id`, `actions`, `come`, `leave`, `count_of`, `cost`, `date`,
        $card = new Card();
        $card->prt_num_id =$prt_num_id;
        $card->actions =$actions;
        $card->come =$come;
        $card->leave =$leave;
        $card->count_of =$count_of;
        $card->price =$price;
        $card->customer =$customer;
        $card->supplier =$supplier ;
        $card->price =$price;
        $card->date =$date;
        $card->save();
    }
}

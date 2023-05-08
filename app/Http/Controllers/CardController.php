<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardController extends Controller
{
    //
    public function card()
    {
        return view('sales.card', [
            'cards' => \App\Card::paginate(20)
        ]);
    }
}

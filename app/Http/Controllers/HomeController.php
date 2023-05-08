<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
//$2y$10$cOFBXLDro8y3c3Tan13ryeinVY3a42Ecy3oriwSZunBCJfOqMU/Ru

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('stores.dashboard', [
            'sales' => \App\Sales_from::select('*')->get(),
            'stores' => \App\Room_of_prd::all()
        ]);    }
}

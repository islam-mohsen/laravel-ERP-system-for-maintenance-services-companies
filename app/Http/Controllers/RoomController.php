<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use \App\Room;
use \App\Room_of_prd;

class RoomController extends Controller
{
    //
    public function addRoom(Request $req, $id)
    {
        if ($req->isMethod('get') && !empty($id)) {
            return view('stores.addroom',
                [
                    'id' => $id,
                    'rooms' => \App\Room::where('store_id', $id)->get()
                ]);
        } elseif (!$req->isMethod('get') && !empty($id)) {
            if (!empty(request('room'))) {
                for ($i = 0; count(request('room')) > $i; $i++) {
                    if (!empty(request('room')[$i])) {
                        DB::table('rooms')->insert(
                            [
                                'name_room' => request('room')[$i],
                                'store_id' => $id,
                            ]
                        );
                    }
                }
            } else {
                return view('stores.addroom',
                    [
                        'id' => $id,
                        'rooms' => \App\Room::where('store_id', $id)->get()
                    ])->withErrors('Enter Room Name');
            }
            session()->flash('addedroom', 'added a New Room(s)');
            return back();
        }
    }

    public function editRoom(Request $req, $id)
    {
        if ($req->isMethod('get') && !empty($id)) {
            return view('stores.editroom',
                [
                    'id' => $id,
                    'roomof' => \App\Room_of_prd::where('room_id', $id)->get()
                ]);
        } elseif (!$req->isMethod('get') && !empty($id)) {
            if (!empty(request('prd_id'))) {
                for ($i = 0; count(request('prd_id')) > $i; $i++) {
                    if (!empty(request('quantity')[$i])) {
                        DB::table('room_of_prds')->insert(
                            [
                                'part_num_id' => request('prd_id')[$i],
                                'quantity' => request('quantity')[$i],
                                'room_id' => $id,
                            ]
                        );
                    }
                }
            } else {
                return view('stores.editroom',
                    [
                        'id' => $id,
                        'roomof' => \App\Room_of_prd::where('room_id', $id)->get()
                    ])->withErrors('Enter Product Name');
            }
            session()->flash('addedProduct1', 'added a New Product(s)');
            return back();
        }
    }

    public function editQuantity(Request $req, $id)
    {
        if ($req->isMethod('get') && !empty($id)) {
            return view('stores.editquantity1',
                [
                    'id' => $id,
                    'quantity' => \App\Room_of_prd::find($id)
                ]);
        } elseif (!$req->isMethod('get') && !empty($id)) {
            $req->validate([
                'quantity' => 'required',
            ]);
            $quantity = Room_of_prd::find($id);
            $quantity->quantity = $req->quantity;
            $quantity->save();
            session()->put('editedquantity', 'edited a quantity');
            return redirect('https://copycomegypt.com/copycomegypt/public/room/edit/' . session()->get('idpage'));
        }
    }

    public function deleteRoom($id)
    {
        Room::deleteRoom($id);
        session()->flash('deleteroom', 'Deletes Room');
        return back();
    }

    public function deleteRoomOfPrd($id)
    {
        Room_of_prd::deleteRoomOfPrd($id);
        session()->flash('deleteroomof', 'Deletes Product Of Room');
        return back();
    }
}

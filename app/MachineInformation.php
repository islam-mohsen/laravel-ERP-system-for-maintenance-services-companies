<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MachineInformation extends Model
{
    //Get calls to machine information
   public function call (){

       return $this->hasMany('App\Call');
   }
   public function machineReport (){

       return $this->hasMany('App\ServiceReport','machine_information_id');
   }
public function engineer (){
  return $this->belongsTo('App\Engineers');
}

    protected $fillable = [
        'name',
        'address',
        'telephone',
        'phone',
        'contact_name',
        'day_of_week',
        'open_time',
        'close_time',
        'model_number',
        'machine_serial',
        'machine_place',
        'contract',
        'contract_start',
        'billing_period',
        'minimum_charge',
        'free_copies',
        'excess_copies',
        'notes',
        'engineer_id',
        // add all other fields
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'machine_informations';
}

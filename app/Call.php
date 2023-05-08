<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\Return_;

class Call extends Model
{
    //connect to manhine informations
    public function machineInformation (){
      Return $this->belongsTo('App\MachineInformation');
    }
public function servicereports (){

        return $this->hasMany('App\ServiceReport');
}
    protected $fillable = [
        'machine_information_id',
        'call_date',
        'call_time',
        'call_type',
        'problem',

        // add all other fields
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'calls';

}

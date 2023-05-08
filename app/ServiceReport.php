<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceReport extends Model
{
    //connect to call
    public function call (){
        Return $this->belongsTo('App\Call');
    }

    public function reportMachine (){
        Return $this->belongsTo('App\MachineInformation' ,'machine_information_id');
    }

    public function engineers (){
        Return $this->belongsTo('App\Engineers');
    }

    public function prd (){
           return $this->belongsToMany('App\Product', 'report_products', 'service_report_id', 'product_id')->withPivot('quantity');;
}
    protected $fillable = [
        'visite_date',
        'meter_reading',
        'work_end',
        'work_start',
        'cust_time',
        'store_time',
        'job_complete',
        'comments',
        'spare_parts',
        'call_id',
        'machine_information_id',
        'engineers_id',

        // add all other fields
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'service_reports';

}

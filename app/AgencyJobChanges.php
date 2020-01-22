<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgencyJobChanges extends Model
{
    use SoftDeletes;
    protected $dates = ['exp_custom_field_1',  'exp_custom_field_2',  'exp_custom_field_3',  'exp_custom_field_4',  'last_alarm_service',  'last_heater_service',  'last_solar_cleaning_service'];

    public function agency()
    {
        return $this->belongsTo('App\User');
    }
    public function originalJob(){
        return $this->hasOne('App\AgencyJobs','id','job_id');
    }
}

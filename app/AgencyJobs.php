<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgencyJobs extends Model
{
    use SoftDeletes;
    protected $dates = ['exp_custom_field_1',  'exp_custom_field_2',  'exp_custom_field_3',  'exp_custom_field_4',  'last_alarm_service',  'last_heater_service',  'last_solar_cleaning_service'];

    public function agency()
    {
        return $this->belongsTo('App\User')->withTrashed();
    }
    public function clonedJob(){
        return $this->hasOne('App\AgencyJobChanges','job_id','id');
    }
    public function invoices()
    {
        return $this->hasMany('App\Invoice','job_id','id');
    }
}

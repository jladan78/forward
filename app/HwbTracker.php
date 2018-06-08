<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HwbTracker extends Model
{
    protected $fillable = [
        'client_id', 'description', 'date_track',
        'sn_value', 'pcls_value','emp_value','nps_value','ips_value',
        'smk_value','sh_value','ph_value','mh_value','dau_value',
        'sn_notes', 'pcls_notes','emp_notes','nps_notes','ips_notes',
        'smk_notes','sh_notes','ph_notes','mh_notes','dau_notes',
        
    ];
    public function client(){
        return $this->belongsTo('App\Client');
    }
    //
}

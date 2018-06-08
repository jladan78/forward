<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mbrp_questionnaire extends Model
{
    protected $table = 'mbrp_questionnaires';
    protected $primaryKey = 'id';

    protected $fillable = [
        'client_id', 'client_age', 'mbrp_programme_id', 'date_engaged',
        'date_completed', 'is_completed', 'end_reason','stage',
        'brs_q','urica_q','datc_q','spsi_q','mh_q','pf_q'
    ];
    public function mbrp_programme(){
        return $this->belongsTo('App\Mbrp_programme', 'mbrp_programme_id');
        //return $this->belongsTo('App\Mbrp_programme');
    }

    public function client(){
        return $this->belongsTo('App\Client');
    }

    public function brsTest(){
        return $this->hasOne('App\BrsTest','id','brs_test_id');
    }

    public function uricaTest(){
        return $this->hasOne('App\UricaTest','id','urica_test_id');
    }
    public function datcTest(){
        return $this->hasOne('App\DatcTest','id','datc_test_id');
    }
    public function spsiTest(){
        return $this->hasOne('App\SpsiTest','id','spsi_test_id');
    }
    public function mhTest(){
        return $this->hasOne('App\MhTest','id','mh_test_id');
    }
    //
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mbrp_programme extends Model
{
    //
    protected $table = 'mbrp_programmes';
    protected $primaryKey = 'id';

    protected $fillable = ['name','description','brs_q','urica_q','datc_q','spsi_q','mh_q','pf_q'];

    public function mbrp_questionnaires()
    {
       return $this->hasMany('App\Mbrp_questionnaire', 'mbrp_programme_id');
        //return $this->hasMany('App\Mbrp_questionnaire');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
     //
    protected $fillable = [
        'id','reference','initials', 'dob','contact', 'contact_phone'
    ];

   
    public function person()
    {
        return $this->belongsTo('App\Person');
    }

    public function mbrp_questionnaire()
    {
        return $this->hasMany('App\Mbrp_questionnaire');
    }
 
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mbrp_parameter extends Model
{
    //
    protected $table = 'mbrp_parameters';
    protected $primaryKey = 'id';
    protected $fillable = ['name','code','description','score','active','field','order','param_type','bottom_value','top_value','opt_prison', 'opt_community'];

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'persons';
    protected $primaryKey = 'id';
    protected $fillable = ['first_name','last_name','id_document','address','phone','email'];

    public function client()
    {
        return $this->hasOne('App\Client');
    }

    public function provedor()
    {
        return $this->hasOne('App\Proveedor');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }


}

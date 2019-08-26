<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'address'];

    public function customer()
    {
        return $this->hasMany('App\Customer');
    }

}

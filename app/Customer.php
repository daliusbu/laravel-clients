<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'phone',
        'email',
        'comment',
        'company_id',
    ];

    public function company()
    {
        return $this->belongsTo('App/Company');
    }
}

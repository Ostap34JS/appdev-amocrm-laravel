<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'company',
        'position',
        'phone',
        'email'
    ];


    public $timestamps = false;
}

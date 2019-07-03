<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'company',
        'position',
        'salary',
        'phone',
        'email'
    ];


    public $timestamps = false;
}

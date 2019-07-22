<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Contact_log extends Model
{
    protected $fillable = [
        'id','topic','details','address','email','tel','time'
    ];

    protected $table = "contact_log";
    protected $appends = [

    ];

    public $incrementing = true;
    public $timestamps = true;

    protected $hidden = [

    ];
}

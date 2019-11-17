<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
        'id','name','address','email','tel'
    ];

    protected $table = "partner";
    protected $appends = [

    ];

    public $incrementing = true;
    public $timestamps = false;

    protected $hidden = [

    ];

}

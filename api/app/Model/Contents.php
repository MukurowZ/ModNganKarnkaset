<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Contents extends Model
{
    protected $fillable = [
        'id','owner_id','type'
    ];

    protected $table = "contents";
    protected $appends = [

    ];

    public $incrementing = true;
    public $timestamps = false;

    protected $hidden = [

    ];
}

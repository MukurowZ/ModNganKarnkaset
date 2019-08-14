<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Img extends Model
{
    protected $fillable = [
        'id','img_set_id','path'
    ];

    protected $table = "img";
    protected $appends = [

    ];

    public $incrementing = true;
    public $timestamps = false;

    protected $hidden = [

    ];


}

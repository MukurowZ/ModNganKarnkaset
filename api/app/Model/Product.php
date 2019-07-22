<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id','name','story','price','img_set_id',
        'description','video','type','owner_id'
    ];

    protected $table = "product";
    protected $appends = [

    ];

    public $incrementing = true;
    public $timestamps = false;

    protected $hidden = [

    ];


}

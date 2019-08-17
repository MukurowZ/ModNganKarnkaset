<?php

namespace App\Model;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use Searchable;
    protected $fillable = [
        'id','name','story','price','img_set_id',
        'description','video','type','owner_id'
    ];

    protected $table = "service";
    protected $appends = [

    ];

    public $incrementing = true;
    public $timestamps = false;

    protected $hidden = [

    ];
}

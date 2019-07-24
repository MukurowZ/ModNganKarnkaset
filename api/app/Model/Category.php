<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'id','name','head'
    ];

    protected $table = "category";
    protected $appends = [

    ];

    public $incrementing = true;
    public $timestamps = false;

    protected $hidden = [

    ];

    public function category(){
        return $this->belongsTo('App\Model\Category','type','name');
    }

}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'id','set_id','path'
    ];

    protected $table = "category";
    protected $appends = [

    ];

    public $incrementing = true;
    public $timestamps = false;

    protected $hidden = [

    ];

    public function categories(){
        return $this->belongsTo('App\Model\Categories','type','name');
    }

}

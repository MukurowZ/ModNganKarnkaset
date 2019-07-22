<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class activities extends Model
{
    protected $fillable = [
        'id','owner_id','activity_name','activity_description',
        'img_set_id','created_on','type'
    ];

    protected $table = "activities";
    protected $appends = [

    ];

    public $incrementing = false;
    public $timestamps = true;

    protected $hidden = [

    ];

    public function contents(){
        return $this->belongsTo('App\Model\Content','id','id');
    }
}

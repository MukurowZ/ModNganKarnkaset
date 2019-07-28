<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'id','event_name','event_description',
        'img_set_id'
    ];
    protected $table = "event";
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

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
        'contentDetail','img'
    ];

    public $incrementing = false;
    public $timestamps = true;

    protected $hidden = [

    ];

    public function contents(){
        return $this->belongsTo('App\Model\Content','id','id');
    }

    public function contentDetail(){
        return $this->hasOne('App\Model\Content','id','id');
    }

    public function getContentDetailAttribute(){
        return $this->attributes['contentDetail'] = Content::where('content.id',$this->attributes['id'])->get();
    }

    public function img(){
        return $this->hasOne('App\Model\Img_set','id','img_set_id');
    }

    public function getImgAttribute(){
        return $this->attributes['img'] = Img::where('img_set_id',$this->attributes['img_set_id'])->get()->first();
    }
}

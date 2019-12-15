<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'id','name','story','price','img_set_id',
        'description','video','type','owner_id'
    ];

    protected $table = "service";
    protected $appends = [
        'img'
    ];

    public $incrementing = true;
    public $timestamps = false;

    protected $hidden = [

    ];

    public function img(){
        return $this->hasOne('App\Model\Img_set','id','img_set_id');
    }

    public function getImgAttribute(){
        return $this->attributes['img'] = Img::where('img_set_id',$this->attributes['img_set_id'])->get()->first();
    }
}

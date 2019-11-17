<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Img_set extends Model
{
    protected $fillable = [
        'id','name','owner_id'
    ];

    protected $table = "img_set";
    protected $appends = [
        'imgid'
    ];

    public $incrementing = true;
    public $timestamps = false;

    protected $hidden = [
        'img'
    ];

    public function img() {
        return $this->hasMany(Img::class);
    }

    public function getImgIdAttribute() {
        return $this->img()->attributes['imgid'] = $this->img;
    }
}

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
        'id'
    ];

    public $incrementing = true;
    public $timestamps = false;

    protected $hidden = [

    ];

    public function getImgAttribute() {
        return $this->attributes['id'] = $this->img;
    }

}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        'id','owner_id','type'
    ];

    protected $table = "content";
    protected $appends = [
        'owner'
    ];

    public $incrementing = true;
    public $timestamps = false;

    protected $hidden = [

    ];

    public function owner(){
        return $this->hasOne('App\Model\User','id','id');
    }

    public function getOwnerAttribute(){
        return $this->attributes['owner'] = User::where('user.id',$this->attributes['owner_id'])->get();
    }
}

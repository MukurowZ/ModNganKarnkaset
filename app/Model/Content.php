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
        'ownerName'
    ];

    public $incrementing = true;
    public $timestamps = false;

    protected $hidden = [

    ];

    public function ownerName(){
        return $this->hasOne('App\Model\User','id','id');
    }

    public function getOwnerNameAttribute(){
        return $this->attributes['ownerName'] = User::where('user.id',$this->attributes['owner_id'])->get('user.name');
    }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Contact_log extends Model
{
    protected $fillable = [
        'id','topic','details','address','email',
        'country_id','tel','updated_at','created_at'
    ];

    protected $table = "contact_log";
    protected $appends = [

    ];

    public $incrementing = true;
    public $timestamps = true;

    protected $hidden = [

    ];

    public function country(){
        return $this->belongsTo('App\Model\Country','country_id','id');
    }
}

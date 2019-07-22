<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'id','userId','email','password',
        'name','lastname','department_id','permission'
    ];

    protected $primaryKey = 'id';
    protected $table = "user";
    protected $appends = [

    ];

    public $incrementing = true;
    public $timestamps = true;

    protected $hidden = [

    ];

}

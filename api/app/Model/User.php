<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

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

    public function getJWTIdentifier() {
        return $this->getKey();
    }
    public function getJWTCustomClaims() {
        return [];
    }

}

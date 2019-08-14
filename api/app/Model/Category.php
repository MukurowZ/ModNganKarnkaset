<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'id','name','head'
    ];

    protected $table = "category";
    protected $appends = [
        'subCategory'
    ];

    public $incrementing = true;
    public $timestamps = false;

    protected $hidden = [
        'head'
    ];

    public function subCategory(){
        return $this->hasMany('App\Model\Category','id','head');
    }

    public function getSubCategoryAttribute(){
        return $this->attributes['subCategory'] = Category::where('category.head',$this->attributes['id'])->get();
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'name',
        'slug',
        'description',
        'stock',
        'price',
        'image',
        'weight'
    ];

    public function categories(){
        return $this -> belongsToMany('App\Models\Category');
    }
}

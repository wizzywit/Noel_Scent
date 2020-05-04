<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    // fillable fields
    protected $fillable = [
        'category_name',
        'description',
        'parent_id',
        'status',
        'url',
        // add all other fields
    ];


    public function subCategories() {
        return $this->hasMany('App\Categories','parent_id');
    }

    public function products() {

        // @param product_id signifies the fk in the relation;
        return $this->hasMany('App\Products','category_id');
    }

}

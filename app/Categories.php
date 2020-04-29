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
        'url',
        // add all other fields
    ];


    public function subCategories() {
        return $this->hasMany('App\Categories','parent_id');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    // fillable fields
    protected $fillable = [
        'category_name',
        'description',
        'url',
        // add all other fields
    ];
}

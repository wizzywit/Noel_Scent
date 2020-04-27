<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    protected $fillable = ['category_id','product_name','product_code','product_color','description','price','image'];
}

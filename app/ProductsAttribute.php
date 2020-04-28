<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsAttribute extends Model
{
    //
    protected $fillable = ['sku','size','stock','price'];

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    protected $fillable = ['category_id','product_name','product_code','product_color','description','price','image','care'];

    public function attributes() {

        // @param product_id signifies the fk in the relation;
        return $this->hasMany('App\ProductsAttribute','product_id');
    }
}

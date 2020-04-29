<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Categories;

class IndexController extends Controller
{
    //

    public function index(){

        $products = Products::orderBy('id','desc')->get();
        $categories = Categories::with('subCategories')->where(['parent_id'=>0])->get();

        // $categories = json_decode(json_encode($categories));
        // echo  "<pre>"; print_r($categories); die; 
        // $products = json_decode(json_encode($products));
        // echo "<pre>"; print_r($products); die;

        
        return view('index')->with(compact('products','categories'));
    }
}

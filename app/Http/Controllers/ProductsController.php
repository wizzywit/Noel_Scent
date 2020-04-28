<?php

namespace App\Http\Controllers;

use App\Products;
use App\ProductsAttribute;
use App\Categories;
use Illuminate\Http\Request;
use Image;
use File;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewProducts()
    {
        //
        $products = Products::orderBy('id','desc')->get();
        $id = 1;
        foreach($products as $product){
            if($product->category_id == '0'){
                $product['category_id'] = "Uncategorized";
            }
            else {
                $category = Categories::where(['id' => $product->category_id])->first();
                $product['category_id'] = $category->category_name;
            }
        }
        return view('admin.products.view_products')->with(compact('products','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addProduct(Request $request)
    {
        //
        if($request->isMethod('post')){
            $data = $request->all();

            // echo"<pre>"; print_r($data); die;

            if(empty($data['category_id'])){
                return redirect()->back()->with('flash_message_error','Product Category is missing: Select a Category or Create New');
            }

            if(empty($data['description'])){
                $data['description'] = '';
            }

            //upload image to folder
            if($request->hasFile('image')){
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()){
                    // echo "test"; die;
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/banckend_images/products/large/'.$filename;
                    $medium_image_path = 'images/banckend_images/products/medium/'.$filename;
                    $small_image_path = 'images/banckend_images/products/small/'.$filename;

                    //Resize Images and save
                    Image::make($image_tmp)->resize(500,500)->save($large_image_path);
                    Image::make($image_tmp)->resize(180,180)->save($medium_image_path);
                    Image::make($image_tmp)->resize(60,60)->save($small_image_path);

                    $data['image'] = $filename;
                }
            }
            

            Products::create([
            'category_id' => $data['category_id'],
            'image' => $data['image'],
            'product_name' => $data['product_name'],
            'product_code' => $data['product_code'],
            'product_color' => $data['product_color'],
            'description' => $data['description'],
            'price' => $data['price'], 
            ]);

            return redirect('/admin/view-products')->with('flash_message_success','Product have been added successfully');
        }
        $categories = Categories::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option value '' selected disabled>::SELECT PRODUCT CATEGORY::</option>";
        foreach ($categories as $category){
            $categories_dropdown .= "<option value='".$category->id."'>".$category->category_name."</option>";
            $sub_categories = Categories::where(['parent_id'=>$category->id])->get();
            foreach($sub_categories as $sub_category){
                $categories_dropdown .= "<option value='".$sub_category->id."'>&nbsp; --&nbsp;".$sub_category->category_name."</option>";
            }
        }
        return view('admin.products.add_product')->with(compact('categories_dropdown'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function editProduct(Request $request, Products $products, $id = null)
    {
        //
        $product = $products->where(['id'=>$id])->first();
        if($request->isMethod('post')){
            $data = $request->all();
            if($request->hasFile('image')){
                //delete previouse images and insert new images
                // echo "Uploaded Image"; die;

                $image_tmp = $request->file('image');
                if($image_tmp->isValid()){
                    // echo "Image is valid"; die;

                    //delete previous saved images
                    $url_small = 'images/banckend_images/products/small/'.$product->image;
                    $url_medium = 'images/banckend_images/products/medium/'.$product->image;
                    $url_large = 'images/banckend_images/products/large/'.$product->image;
                    

                    $del1 = File::delete($url_small);
                    $del2 = File::delete($url_large);
                    $del3 = File::delete($url_medium);

                    //insert new images into various folders with different names generated

                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/banckend_images/products/large/'.$filename;
                    $medium_image_path = 'images/banckend_images/products/medium/'.$filename;
                    $small_image_path = 'images/banckend_images/products/small/'.$filename;

                    //Resize Images and save
                    Image::make($image_tmp)->resize(500,500)->save($large_image_path);
                    Image::make($image_tmp)->resize(180,180)->save($medium_image_path);
                    Image::make($image_tmp)->resize(60,60)->save($small_image_path);

                    //assign new generated file name to image props
                    $data['image'] = $filename;
                }
            }
            if(!$request->hasFile('image')){
                $data['image'] = $product->image;
                // echo $data['image']; die;
            }
            // echo "didnt upload image"; die;

            if(empty($data['description'])){
                $data['description'] = '';
            }

            $product->update([
            'category_id' => $data['category_id'],
            'image' => $data['image'],
            'product_name' => $data['product_name'],
            'product_code' => $data['product_code'],
            'product_color' => $data['product_color'],
            'description' => $data['description'],
            'price' => $data['price'],
            ]);
            return redirect('/admin/view-products')->with('flash_message_success',$data['product_name'].' Product updated Successfully');
        }
        if($product->count() > 0){
            // echo "<pre>"; print_r($project->id); die;
            $categories = Categories::where(['parent_id'=>0])->get();
            $categories_dropdown = "";
            foreach ($categories as $category){
                if($category->id == $product->id){
                    $setected ="selected";
                } else {
                    $setected ="";  
                }
                $categories_dropdown .= "<option value='".$category->id."'>".$category->category_name."</option>";
                $sub_categories = Categories::where(['parent_id'=>$category->id])->get();
                foreach($sub_categories as $sub_category){
                    if($sub_category->id == $product->id){
                        $setected ="selected";
                    }else {
                        $setected ="";  
                    }
                    $categories_dropdown .= "<option value='".$sub_category->id."'>&nbsp; --&nbsp;".$sub_category->category_name."</option>";
                }
            }
            return view('admin.products.edit_product')->with(compact('product','categories_dropdown'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function deleteProducts(Products $products, $id = null)
    {
        //
        $product = $products->where(['id'=>$id])->first();
        $url_small = 'images/banckend_images/products/small/'.$product->image;
        $url_medium = 'images/banckend_images/products/medium/'.$product->image;
        $url_large = 'images/banckend_images/products/large/'.$product->image;
        

        $del1 = File::delete($url_small);
        $del2 = File::delete($url_large);
        $del3 = File::delete($url_medium);

        $product->delete();
        if($product){
            return redirect()->back()->with('flash_message_success',$product['product_name'].' Product Deleted Successfully');
        }
        
    }

    public function addAttributes(Request $request, Products $products, $id = null){

        $product = $products->where(['id'=>$id])->first();
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data);

            foreach($data['sku'] as $key => $val){
                if(!empty($val)){
                    $attribute = new ProductsAttribute;
                    $attribute->sku = $val;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->product_id = $product->id;
                    $attribute->save();
                }
            }
            return redirect('/admin/add-attributes/'.$product->product_id)->with('flash_message_success','Product Attributes added successfully');
        }else {
        if($product->count() > 0){
            return view('admin.products.add_attributes')->with(compact('product'));
        }

    }
    }
}

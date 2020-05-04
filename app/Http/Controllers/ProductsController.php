<?php

namespace App\Http\Controllers;

use App\Products;
use App\ProductsAttribute;
use App\ProductsImage;
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
            if(empty($data['care'])){
                $data['care'] = '';
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
            'care'=> $data['care'],
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
            if(empty($data['care'])){
                $data['care'] = '';
            }

            $product->update([
            'category_id' => $data['category_id'],
            'image' => $data['image'],
            'product_name' => $data['product_name'],
            'product_code' => $data['product_code'],
            'product_color' => $data['product_color'],
            'description' => $data['description'],
            'care'=>$data['care'],
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
        //find product details
        $product = $products->with('images')->where(['id'=>$id])->first();

        foreach($product->images as $image){
            $this->deleteImageOnly($image->image);
        }

        //delete product images first
        $this->deleteImageOnly($product->image);

        //if deleted
       
        $product->delete();
        if($product){
            return redirect()->back()->with('flash_message_success',$product['product_name'].' Product Deleted Successfully');
        } else return redirect()->back()->with('flash_message_error',$product['product_name'].' Product Deletion Failed');
      
        
    }

    public function addAttributes(Request $request, Products $products, $id = null){

        $product = $products->with('attributes')->where(['id'=>$id])->first();
        // $product = json_decode(json_encode($product));
        $id = 1;
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($product); die;

            foreach($data['sku'] as $key => $val){
                if(!empty($val)){

                    //SKU Check
                    $attrCountSKU = ProductsAttribute::where(['sku'=>$val, 'product_id'=>$product->id])->count();
                    if($attrCountSKU >0){
                        return redirect()->back()->with('flash_message_error','SKU duplicate: Can\'t have multiple sku value')->with(compact('id'));
                    }

                    $attrCountSize = ProductsAttribute::where(['size'=>$data['size'][$key], 'product_id'=>$product->id])->count();
                    if($attrCountSize >0){
                        return redirect()->back()->with('flash_message_error','Size duplicate: Can\'t have multiple size values')->with(compact('id'));
                    }
                    $attribute = new ProductsAttribute;
                    $attribute->sku = $val;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->product_id = $product->id;
                    $attribute->save();
                }
            }
            return redirect()->back()->with('flash_message_success','Product Attributes added successfully')->with(compact('id'));
        }else {
        if($product->count() > 0){
            return view('admin.products.add_attributes')->with(compact('product','id'));
          }

        }
    }

    public function deleteAttribute($id = null) {
        $attribute = ProductsAttribute::where(['id'=>$id])->first()->delete();
        if($attribute){
            return redirect()->back()->with('flash_message_success','Attribute Deleted successfully');
        } else return redirect()->back()->with('flash_message_error','Attribute Deletion Failed');

    }

    public function products($url = null) {

        $category = Categories::where(['url'=>$url, 'status' =>1])->get();
        
        if($category->count() == 0){
           abort(404);
        }

        $category = Categories::where(['url'=>$url])->first();
        //if category is a parent category
        if($category->parent_id == 0){

            $subCats = Categories::where(['parent_id'=>$category->id])->get();
            $cat_ids = "";
            foreach($subCats as $subCat ){
                $cat_ids .= $subCat->id.",";
            }

            // echo $cat_ids; die;
            //whereIn is used too check if a column value is same as any value in an array
            $products = Products::whereIn('category_id', array($cat_ids))->get();

        }else {
            $products = Products::where(['category_id'=>$category->id])->get();
        } // else its a sub category


        // echo "<pre>"; print_r($products); die;


        return view('products.index')->with(compact('products','category'));
    }

    public function product($id = null){
        $productDetails = Products::with('attributes')->where(['id'=>$id])->first();
        if($productDetails){
            return view('products.product_details')->with(compact('productDetails')); 
        }
        else {
            abort(404);
        }
    }

    public function getProductPrice(Request $request) {
        $data = $request->all();
        $proArr = explode('-',$data['idSize']);
        // echo $proArr[0]; echo $proArr[1]; die;

        $proAttr = ProductsAttribute::where(['size'=>$proArr[1], 'product_id'=>$proArr[0]])->first();
        
        echo $proAttr->price;
    }

    public function addImages(Request $request, Products $products, $id = null){

        $product = $products->with('images')->where(['id'=>$id])->first();
        // $product = json_decode(json_encode($product));
        $id = 1;
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            if($request->hasFile('image')){
                $files = $request->file('image');
                // echo "<pre>"; print_r($files); die;

                //upload Images after resize
                foreach($files as $file){
                    $extension = $file->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;

                    $large_image_path = 'images/banckend_images/products/large/'.$filename;
                    $medium_image_path = 'images/banckend_images/products/medium/'.$filename;
                    $small_image_path = 'images/banckend_images/products/small/'.$filename;

                    //Resize Images and save
                    Image::make($file)->resize(500,500)->save($large_image_path);
                    Image::make($file)->resize(180,180)->save($medium_image_path);
                    Image::make($file)->resize(60,60)->save($small_image_path);
    
                    $image = ProductsImage::create([
                        'image'=>$filename,
                        'product_id'=>$product->id
                    ]);

                    if($image){
                        continue;
                    }else{
                        echo "Error saving"; die;
                    }
                }

                return redirect()->back()->with(compact('product','id'));
               


            }
        }else {
        if($product->count() > 0){

            return view('admin.products.add_images')->with(compact('product','id'));
          }

        }
    }

    public function deleteImage($id = null) {
        $image = ProductsImage::where(['id'=>$id])->first();
        $this->deleteImageOnly($image->image);

        $image = $image->delete();
        if($image){
            return redirect()->back()->with('flash_message_success','Image Deleted successfully');
        } else return redirect()->back()->with('flash_message_error','Image Deletion Failed');

    }

    function deleteImageOnly($image){
        $url_small = 'images/banckend_images/products/small/'.$image;
        $url_medium = 'images/banckend_images/products/medium/'.$image;
        $url_large = 'images/banckend_images/products/large/'.$image;
        

        return File::delete($url_small,$url_large,$url_medium);
        
    }

}

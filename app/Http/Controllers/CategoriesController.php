<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;

class CategoriesController extends Controller
{
    // 
    public function addCategory(Request $request) {
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $category = new Categories;
            $category->parent_id = $data['parent_id'];
            $category->category_name = $data['category_name'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->save();
            return redirect('/admin/view-category')->with('flash_message_success',$data['category_name'].' Category added Successfully');
        }
        $levels = Categories::where(['parent_id'=>0])->get();
        return view('admin.categories.add_category')->with(compact('levels'));
    }

    public function viewCategories(){
        $categories = Categories::orderBy('id', 'desc')->get();
        $id = 1;
        foreach ($categories as $category){
            if($category->parent_id == '0'){
                $category['parent_id'] = "Parent Category";
            }
            else {
                $parent = Categories::where(['id'=>$category->parent_id])->first();
                $category['parent_id'] = $parent->category_name;
            }
        }
        return view('admin.categories.view_categories')->with(compact('categories','id'));
    }

    public function editCategory(Request $request, $id = null) {
        $category = Categories::where(['id'=> $id])->first();
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $category->update([
                'category_name' => $data['category_name'],
                'description' => $data['description'],
                'parent_id' => $data['parent_id'],
                'url' => $data['url'],
            ]);
            return redirect('/admin/view-category')->with('flash_message_success',$data['category_name'].' Category update Successfully');
        }
        $category = Categories::where(['id'=> $id])->first();
        // echo "<pre>"; print_r($category['description']); die;
        $levels = Categories::where(['parent_id'=>0])->get();
        return view('admin.categories.edit_category')->with(compact('category','levels'));
    }

    public function deleteCategory($id = null){
        if(!empty($id)){
            $category = Categories::where(['id'=>$id])->first();
            $category->delete();
            if($category){
                return redirect()->back()->with('flash_message_success',$category['category_name'].' Category Deleted Successfully');
            }
        }
    }
}

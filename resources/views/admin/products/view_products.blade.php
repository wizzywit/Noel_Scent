@extends('layouts.adminLayout.admin_design')

@section('content')
<!--main-container-part-->

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Products</a> </div>
    <h1>Products</h1>
  </div>
  <div class="container-fluid">
    <hr>
    @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{!! session('flash_message_success') !!}</strong>
        </div>
    @endif
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Categories</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>S/N</th>
                  <th>Product Name</th>
                  <th>Product Category</th>
                  <th>Product Code</th>
                  <th>Product Price</th>
                  <th>Product Color</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody >
                @foreach($products as $product)
                <tr class="gradeX">
                  <td>{{ $id++ }}</td>
                  <td>{{ $product->product_name }}</td>
                  <td>{{ $product->category_id }}</td>
                  <td>{{ $product->product_code }}</td>
                  <td>{{ $product->price }}</td>
                  <td>{{ $product->product_color }}</td>
                  <td>{{ $product->description }}</td>
                  <td>
                      @if(!empty($product->image))
                      <img src="{{ asset('/images/banckend_images/products/small/'.$product->image) }}" style="width:60px;">
                      @endif
                  </td>
                <td><a href="{{url('/admin/edit-product/'.$product->id) }}" class="btn btn-primary btn-mini">Edit</a> <a href="#myModal{{$product->id}}" data-toggle="modal" class="btn btn-success btn-mini">View</a> <a  data-toggle="modal" href="#myAlert{{$product->id}}" class="btn btn-danger btn-mini delCat">Delete</a>
                </td>
                </tr>
                <div id="myModal{{$product->id}}" class="modal hide">
                <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button">×</button>
                    <h3>{{$product->product_name}} Full Details</h3>
                </div>
                <div class="modal-body">
                    <p>Product code: {{$product->product_code}}</p>
                    <p>Product Category: {{$product->category_id}}</p>
                    <p>Product Color: {{$product->product_color}}</p>
                    <p>Price: {{$product->price}}</p>
                    <p>Description: {{$product->description}}</p>
                </div>
                </div>

                <div id="myAlert{{$product->id}}" class="modal hide">
                    <div class="modal-header">
                        <button data-dismiss="modal" class="close" type="button">×</button>
                        <h3>Delete Notification</h3>
                    </div>
                    <div class="modal-body">
                        <p>Are You sure you want to proceed to delete {{$product->product_name}}</p>
                    </div>
                    <div class="modal-footer"> <a class="btn btn-primary" href="{{ url('/admin/delete-product/'.$product->id) }}">Confirm</a> <a data-dismiss="modal" class="btn" href="#">Cancel</a> </div>
                </div>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--end-main-container-part-->
@endsection
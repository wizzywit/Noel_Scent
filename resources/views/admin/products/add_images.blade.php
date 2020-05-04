@extends('layouts.adminLayout.admin_design')

@section('content')
<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ url('/admin/view-products')}}">Products</a> <a href="#" class="current">Add Product Images</a> </div>
    <h1>Product Images</h1>
  </div>
  <div class="container-fluid"><hr>
  @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{!! session('flash_message_success') !!}</strong>
        </div>
    @endif
    @if(Session::has('flash_message_error'))
        <div class="alert alert-error alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{!! session('flash_message_error') !!}</strong>
        </div>
    @endif
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add Product Images</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/admin/add-images/'.$product->id) }}" name="add_images" id="add_images" >
              @csrf
              <div class="control-group">
                <label class="control-label">Product Name</label>
                <label class="control-label"><strong>{{ $product->product_name }}</strong></label>
              </div>
              <div class="control-group">
                <label class="control-label">Product Code</label>
                <label class="control-label"><strong>{{ $product->product_code }}</strong></label>
              </div>
              <div class="control-group">
                <label class="control-label">Product Color</label>
                <label class="control-label"><strong>{{ $product->product_color }}</strong></label>
              </div>
              <div class="control-group">
                <label class="control-label">Alternate Image(s)</label>
                <div class="controls">
                  <input type="file" name="image[]" id="image" multiple="multiple">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Add Images" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
              <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                    <h5>Product Images</h5>
              </div>
              <div class="widget-content nopadding">
              <table class="table table-bordered data-table">
                <thead>
                    <tr>
                    <th>S/N</th>
                    <th>Product ID</th>
                    <th>Images</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody >
                   @foreach($product->images as $image)
                   <tr class="gradeX">
                    <td>{{ $id++ }}</td>
                    <td>{{ $product->id }}</td>
                    <td>
                        <img src="{{ asset('/images/banckend_images/products/small/'.$image->image) }}" style="width:60px;">
                    </td>
                    <td><a rel="{{$image->id}}" rel1="delete-image"  href="javascript:" class="delConfirm" style="color:red;">Delete</a></td>
                   </tr>
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
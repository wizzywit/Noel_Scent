@extends('layouts.adminLayout.admin_design')

@section('content')
<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ url('/admin/view-products')}}">Products</a> <a href="#" class="current">Add Product Attributes</a> </div>
    <h1>Product Attributes</h1>
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
            <h5>Add Product Attributes</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/admin/add-attribute/'.$product->id) }}" name="add_attribute" id="add_attribute" >
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
                <label class="control-label"></label>
                <div class="controls">
                <div class="field_wrapper">
                    <div>
                        <input type="text" name="sku[]" id="sku" placeholder="SKU" style="width:120px;" required/>
                        <input type="text" name="size[]" id="size" placeholder="Size" style="width:120px;" required/>
                        <input type="text" name="price[]" id="price" placeholder="Price" style="width:120px;" required/>
                        <input type="text" name="stock[]" id="stock" placeholder="Stock" style="width:120px;" required/>
                        <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                    </div>
                </div>
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Add Attribute" class="btn btn-success">
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
                    <h5>Product Attributes</h5>
              </div>
              <div class="widget-content nopadding">
              <table class="table table-bordered data-table">
                <thead>
                    <tr>
                    <th>S/N</th>
                    <th>SKU</th>
                    <th>SIZE</th>
                    <th>PRICE</th>
                    <th>STOCK</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody >
                    @foreach($product->attributes as $attribute)
                    <tr class="gradeX">
                    <td>{{ $id++ }}</td>
                    <td>{{ $attribute->sku }}</td>
                    <td>{{ $attribute->size }}</td>
                    <td>{{ $attribute->price }}</td>
                    <td>{{ $attribute->stock }}</td>
                    <td><a rel="{{$attribute->id}}" rel1="delete-attribute"  href="javascript:" class="delConfirm" style="color:red;">Delete</a></td>
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
@extends('layouts.home')

@section('title','Product')

@section('Product')
    active    
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Product</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item "><a href="{{route('products')}}">Product</a></li>
              <li class="breadcrumb-item active">Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            @foreach ($errors->all() as $error)
                @if ($error)
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Error!</strong> {{ $error }}
                    </div>
                @endif
            @endforeach

            
            <div class="card card-muted">
              <div class="card-header card-border">
                <h3 class="card-title text-secondary"> Product </h3>
              <a href="{{route('products')}}"><button type="submit" class="btn btn-info pull-right">Back</button></a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" id="quickForm" method="POST" action="{{route('product.update')}}" >
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product Name
                        <span style="color: red;">*</span>
                    </label>
                    <input type="text" name="product_name" required class="form-control  {{$errors->has('product_name') ? 'is-invalid' : ''}}" id="customer_name" placeholder="Enter unit" value="{{ $product->product_name }}">
                    {{-- Error handling --}}
                    {{-- @if($errors->has('customer_name'))
                        <span class="text-danger">{{$errors->first('customer_name')}}</span>
                    @endif --}}
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Select Category</label>
                    <select class="form-control" name="category_id">
                      <option selected="" disabled="">Please Select Category</option>
                      @foreach($categories as $category)
                        <option {{$category->category_id == $product->category_id ? 'selected' : ''}} value="{{$category->category_id}}"> {{$category->category_name}} </option>
                        </option>
                      @endforeach
                    </select>
                  </div>

                <input type="hidden" name="product_id" value="{{$product->product_id}}">
                  
                  
                  {{-- <div class="form-group mb-0">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                      <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
                    </div>
                  </div> --}}
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </section>
            </div>
            <!-- /.card -->
@endsection             
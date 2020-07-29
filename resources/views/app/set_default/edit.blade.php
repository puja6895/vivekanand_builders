@extends('layouts.home')

@section('title','Set Deafault | Add')

@section('Set Deafault')
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
            <h3>
                Default Product
            </h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item "><a href="{{route('default_products')}}">  Default Product</a></li>
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
                <a href="{{route('default_products')}}"><button type="submit" class="btn btn-info pull-right ">Back</button></a>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
              <form role="form" id="quickForm" method="POST" action="{{route('default_product.update')}}" >
                  @csrf
                  <div class="card-body">
                    
  
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Name <span style="color: red;">*</span></label>
                      <select class="form-control select2" name="product_id">
                        <option selected="" disabled="" value="{{$default_product->product_id}}">{{$default_product->product->product_name}} </option>
                        {{-- @foreach($products as $product)
                          <option value="{{$product->product_id}}">
                            {{$product->product_name}}
                          </option>
                        @endforeach --}}
                        
                      </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Unit Name <span style="color: red;">*</span></label>
                        <select class="form-control select2" name="unit_id">
                          <option selected="" disabled="" value="{{$default_product->unit_id}}">{{$default_product->unit->first()->unit_name}}</option>
                          {{-- @foreach($units as $unit)
                            <option value="{{$unit->unit_id}}">
                              {{$default_product->unit->first()->unit_name}}
                            </option>
                          @endforeach --}}
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Sell Price Per Unit
                            <span style="color: red;">*</span>
                        </label>
                        <input type="text" name="sell_price" required class="form-control  {{$errors->has('sell_price') ? 'is-invalid' : ''}}" id="sell_price" placeholder="Enter Price" value="{{$default_product->sell_price }}">
                        {{-- Error handling --}}
                        {{-- @if($errors->has('customer_name'))
                            <span class="text-danger">{{$errors->first('customer_name')}}</span>
                        @endif --}}
                        
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Purchase Price Per Unit
                            <span style="color: red;">*</span>
                        </label>
                        <input type="text" name="purchase_price" required class="form-control  {{$errors->has('product_name') ? 'is-invalid' : ''}}" id="purchase_price" placeholder="Enter Price" value="{{ $default_product->purchase_price}}">
                        {{-- Error handling --}}
                        {{-- @if($errors->has('customer_name'))
                            <span class="text-danger">{{$errors->first('customer_name')}}</span>
                        @endif --}}
                        <input type="hidden" name="default_id" value="{{$default_product->default_id}}">
                    </div>
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
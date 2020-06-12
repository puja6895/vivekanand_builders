@extends('layouts.home')

@section('title','Sales')

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
              <li class="breadcrumb-item active">Add</li>
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
            <form role="form" id="quickForm" method="POST" action="{{route('sell.store')}}" >
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Select Customer</label>
                        <select class="form-control" name="customer_id">
                          <option selected="" disabled="">Please Select Customer</option>
                          @foreach($customers as $customer)
                            <option value="{{$customer->customer_id}}">
                              {{$customer->customer_name}}
                            </option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Sell Date
                            {{-- <span style="color: red;">*</span> --}}
                        </label>
                        <input type="text" name="sell_date" class="form-control datepicker" id="datepicker" required="" placeholder="dd-mm-yyyy">
                        {{-- Error handling --}}
                        {{-- @if($errors->has('customer_name'))
                            <span class="text-danger">{{$errors->first('customer_name')}}</span>
                        @endif --}}
                        
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Payment Recived
                            {{-- <span style="color: red;">*</span> --}}
                        </label>
                        <input type="text" name="payment_recived" required class="form-control  {{$errors->has('payment_recived') ? 'is-invalid' : ''}}" id="payment_recived" placeholder="Enter Product" value="{{ old('payment_recived')}}">
                        {{-- Error handling --}}
                        {{-- @if($errors->has('customer_name'))
                            <span class="text-danger">{{$errors->first('customer_name')}}</span>
                        @endif --}}
                        
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Amount
                            {{-- <span style="color: red;">*</span> --}}
                        </label>
                        <input type="text" name="total_amount" required class="form-control  {{$errors->has('total_amount') ? 'is-invalid' : ''}}" id="total_amount" placeholder="Enter Product" value="{{ old('total_amount')}}">
                        {{-- Error handling --}}
                        {{-- @if($errors->has('customer_name'))
                            <span class="text-danger">{{$errors->first('customer_name')}}</span>
                        @endif --}}
                        
                      </div>
    

                  {{-- <div class="form-group">
                    <label for="exampleInputEmail1">Select Category</label>
                    <select class="form-control" name="category_id">
                      <option selected="" disabled="">Please Select Category</option>
                      @foreach($categories as $category)
                        <option value="{{$category->category_id}}">
                          {{$category->category_name}}
                        </option>
                      @endforeach
                    </select>
                  </div> --}}
                  
                  
                  {{-- <div class="form-group mb-0">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                      <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
                    </div>
                  </div> --}}
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Add Product</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </section>
            </div>
            <!-- /.card -->
@endsection             
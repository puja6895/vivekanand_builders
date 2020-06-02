@extends('layouts.home')

@section('title','Customers | Edit')

@section('clients')
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
            <h3>Edit Customer</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item "><a href="{{route('customers')}}">Customer</a></li>
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
              <div class="card-header">
              <h3 class="card-title text-secondary">Edit <span >{{$customer->customer_name}}'s</span> details</h3>
              <a href="{{route('customers')}}"><button type="submit" class="btn btn-info pull-right">Back</button></a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" id="quickForm" method="POST" action="{{route('customer.update')}}" >
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Customer Name
                        <span style="color: red;">*</span>
                    </label>
                    <input type="text" name="customer_name" required class="form-control  {{$errors->has('customer_name') ? 'is-invalid' : ''}}" id="customer_name" placeholder="Enter name of customer" value="{{ $customer->customer_name}}">
                    {{-- Error handling --}}
                    {{-- @if($errors->has('customer_name'))
                        <span class="text-danger">{{$errors->first('customer_name')}}</span>
                    @endif --}}
                    
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Customer Email</label>
                    <input type="email" name="customer_email" class="form-control {{$errors->has('customer_email') ? 'is-invalid' : ''}}" id="customer_email" placeholder="Enter email of customer" value="{{ $customer->customer_email }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Customer Mobile
                        <span style="color: red;">*</span>
                    </label>
                    <input type="number" name="customer_mobile" required class="form-control {{$errors->has('customer_mobile') ? 'is-invalid' : ''}}" id="customer_mobile" placeholder="Enter number of customer" value="{{ $customer->customer_mobile}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Customer Address</label>
                    <input type="text" name="customer_address" class="form-control" id="customer_address" placeholder="Enter address of customer" value="{{ $customer->customer_address }}">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">GST Number</label>
                    <input type="text" name="gst_no" class="form-control" id="gst_no" placeholder="Enter customer's GST Number" value="{{ $customer->gst_no}}">
                  </div>
                  {{-- <div class="form-group mb-0">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                      <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
                    </div>
                  </div> --}}
                </div>
                <input type="hidden" name="customer_id" value="{{$customer->customer_id}}">
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
<!-- /.content-wrapper -->
    
@endsection
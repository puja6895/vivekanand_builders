@extends('layouts.home')

@section('title','Purchaser | Add')

@section('Supliers')
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
            <h3>Purchaser</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item "><a href="{{route('purchasers')}}">Purchaser</a></li>
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
              <div class="card-header">
                <h3 class="card-title text-secondary">Edit Purchaser </h3>
              <a href="{{route('purchasers')}}"><button type="submit" class="btn btn-info pull-right">Back</button></a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" id="quickForm" method="POST" action="{{route('purchaser.update')}}" >
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Purchaser Name
                        <span style="color: red;">*</span>
                    </label>
                    <input type="text" name="purchaser_name" required class="form-control  {{$errors->has('purchaser_name') ? 'is-invalid' : ''}}" id="purchaser_name" placeholder="Enter name of Purchaser" value="{{ $purchaser->purchaser_name }}">
                    {{-- Error handling --}}
                    {{-- @if($errors->has('customer_name'))
                        <span class="text-danger">{{$errors->first('customer_name')}}</span>
                    @endif --}}
                    
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Purchaser Email</label>
                    <input type="email" name="purchaser_email" class="form-control {{$errors->has('purchaser_email') ? 'is-invalid' : ''}}" id="purchaser_email" placeholder="Enter email of Purchaser" value="{{ $purchaser->purchaser_email}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Purchaser Mobile
                        {{-- <span style="color: red;">*</span> --}}
                    </label>
                    <input type="number" name="purchaser_mobile"  class="form-control {{$errors->has('purchaser_mobile') ? 'is-invalid' : ''}}" id="purchaser_mobile" placeholder="Enter number of Purchaser" value="{{ $purchaser->purchaser_mobile }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Purchaser Address</label>
                    <input type="text" name="purchaser_address" class="form-control" id="purchaser_address" placeholder="Enter address of Purchaser" value="{{ $purchaser->purchaser_address}}">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Company</label>
                    <input type="text" name="company_name" class="form-control" id="company_name" placeholder="Enter customer's Company Namer" value="{{ $purchaser->company}}">
                  </div>
                  {{-- <div class="form-group mb-0">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                      <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
                    </div>
                  </div> --}}
                <input type="hidden" name="purchaser_id" value="{{$purchaser->purchaser_id}}">
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
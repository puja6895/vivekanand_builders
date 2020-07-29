@extends('layouts.home')

@section('title','Lorry')

@section('Lorry')
    active    
@endsection

{{-- @section('Master-unit')
    active    
@endsection --}}

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Lorry</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item "><a href="{{route('lorry_reports')}}">Lorry</a></li>
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
                <h3 class="card-title text-secondary">Add Lorry </h3>
              <a href="{{route('lorry_reports')}}"><button type="submit" class="btn btn-info pull-right">Back</button></a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" id="quickForm" method="POST" action="{{route('lorry_report.store')}}" >
                @csrf
                <div class="card-body">
                  <div class="row">
                    {{-- Sell To Name --}}
                    <div class="col-md-6">
                      <div class="form-group {{ $errors->has('customer_id') ? ' has-error' : '' }}">
                        <label>Customer <span style="color: red;">*</span></label>
                        {{-- <div class="input-group"> --}}
                          {{-- <div class="input-group-prepend">
                            <label class="input-group-text" for="customer_id">
                                <i class="fa fa-user"></i>
                            </label>
                          </div> --}}
                          <select required class="form-control select2" id="customer_id" name="customer_id">
                            <option selected="" disabled="">Select Customer</option>
                            @foreach($customers as $customer)
                            <option value="{{$customer->customer_id}}">{{$customer->customer_name}}</option>
                            @endforeach
                          </select>
                        {{-- </div> --}}
                      </div>
                    </div>
  
                    <!--Purchase DATE  -->
                    <div class="col-md-6">
                      <div class="form-group {{ $errors->has('sell_date') ? ' has-error' : '' }}">
                        <label>Sell Date <span style="color: red;">*</span></label>
                        <div class="input-group">
                          {{-- <div class="input-group-prepend">
                            <label class="input-group-text" for="datepicker">
                              <i class="fa fa-calendar"></i>
                            </label>
                          </div> --}}
                          <input type="text" name="date" class="form-control datepicker list_date " id="datepicker" required="" placeholder="dd-mm-yyyy">
                          @if ($errors->has('date'))
                          <span class="help-block">
                              <strong>{{ $errors->first('date') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Lorry Name <span style="color: red;">*</span></label>
                    <select class="form-control select2" name="lorry_id">
                      <option selected="" disabled="">Please Select Lorry</option>
                      @foreach($lorries as $lorry)
                        <option value="{{$lorry->lorry_id}}">
                          {{$lorry->lorry_no}}
                        </option>
                      @endforeach
                    </select>
                </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Product Name <span style="color: red;">*</span></label>
                    <select class="form-control select2" name="product_id">
                      <option selected="" disabled="">Please Select Product </option>
                      @foreach($products as $product)
                        <option value="{{$product->product_id}}">
                          {{$product->product_name}}
                        </option>
                      @endforeach
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">From<span style="color: red;">*</span>
                    </label>
                    <input type="text" name="from" required class="form-control  {{$errors->has('from') ? 'is-invalid' : ''}}" id="from" placeholder="Enter Destination" value="{{ old('from')}}">
                    {{-- Error handling --}}
                    {{-- @if($errors->has('customer_name'))
                        <span class="text-danger">{{$errors->first('customer_name')}}</span>
                    @endif --}}
                    
                </div>

              <div class="form-group">
                <label for="exampleInputEmail1">To
                    <span style="color: red;">*</span>
                </label>
                <input type="text" name="to" required class="form-control  {{$errors->has('to') ? 'is-invalid' : ''}}" id="to" placeholder="Enter Destination" value="{{ old('to')}}">
                {{-- Error handling --}}
                {{-- @if($errors->has('customer_name'))
                    <span class="text-danger">{{$errors->first('customer_name')}}</span>
                @endif --}}
            </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Unit Name <span style="color: red;">*</span></label>
                <select class="form-control select2" name="unit_id">
                  <option selected="" disabled="">Please Select Unit</option>
                  @foreach($units as $unit)
                    <option value="{{$unit->unit_id}}">
                      {{$unit->unit_name}}
                    </option>
                  @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Weight
                    <span style="color: red;">*</span>
                </label>
                <input type="number" name="weight" required class="form-control  {{$errors->has('weight') ? 'is-invalid' : ''}}" id="weight" placeholder="Enter Weight" value="{{ old('weight')}}">
                {{-- Error handling --}}
                {{-- @if($errors->has('customer_name'))
                    <span class="text-danger">{{$errors->first('customer_name')}}</span>
                @endif --}}
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Rate
                  <span style="color: red;">*</span>
              </label>
              <input type="number" name="rate" required class="form-control  {{$errors->has('rate') ? 'is-invalid' : ''}}" id="rate" placeholder="Enter Rate" value="{{ old('rate')}}">
              {{-- Error handling --}}
              {{-- @if($errors->has('customer_name'))
                  <span class="text-danger">{{$errors->first('customer_name')}}</span>
              @endif --}}
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Advance Amount
                  <span style="color: red;">*</span>
              </label>
              <input type="number" name="advance_amount" required class="form-control  {{$errors->has('advance_amount') ? 'is-invalid' : ''}}" id="advance_amount" placeholder="Enter Advance Amount" value="{{ old('advance_amount')}}">
              {{-- Error handling
              @if($errors->has('customer_name'))
                  <span class="text-danger">{{$errors->first('customer_name')}}</span>
              @endif --}}
          </div>
            

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Add Lorry</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </section>
            </div>
            <!-- /.card -->
@endsection             
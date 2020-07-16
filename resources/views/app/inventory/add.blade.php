@extends('layouts.home')

@section('title','Inventory')

@section('Inventory')
    active    
@endsection

@section('Master-unit')
    active    
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   {{-- {{ dd($products->product_name) }} --}}
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Unit</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item "><a href="{{route('inventories')}}">Inventory</a></li>
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
                <h3 class="card-title text-secondary">Add Inventory </h3>
              <a href="{{route('inventories')}}"><button type="submit" class="btn btn-info pull-right">Back</button></a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" id="quickForm" method="POST" action="{{route('inventory.store')}}" >
                @csrf
                <div class="card-body">
                    {{-- Date --}}
                    <div class="form-group">
                        <label>Date <span style="color: red;">*</span></label>
                      <div class="form-group">
                        <input type="text" name="date" class="form-control datepicker list_date" id="datepicker" required="" placeholder="dd-mm-yyyy">
                        @if ($errors->has('date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('date') }}</strong>
                        </span>
                        @endif
                      </div>
                    </div>
                    {{-- Product Name --}}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Name
                            <span style="color: red;">*</span>
                        </label>
                        <select required class="form-control select2" id="product_id" name="product_id">
                            <option selected="" disabled="">Select Product</option>
                            @foreach($products as $product)
                            <option value="{{$product->product_id}}">{{$product->product_name}}</option>
                            @endforeach
                          </select>
                    </div>
                     {{-- Unit Name --}}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Unit Name
                            <span style="color: red;">*</span>
                        </label>
                        <select class="form-control select2" name="unit_name" id="unit_name ">
                            <option disabled="" selected="">Select Product</option>
                            @foreach($units as $unit)
                            <option value="{{$unit->unit_name}}">{{$unit->unit_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- Quantitiy --}}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Quantity
                            <span style="color: red;">*</span>
                        </label>
                        <input type="text" name="quantity" required class="form-control  {{$errors->has('quantity') ? 'is-invalid' : ''}}" id="quantity" placeholder="Enter Quantity" value="{{ old('quantity')}}">
                    </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Add Stock</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </section>
            </div>
            <!-- /.card -->
@endsection             

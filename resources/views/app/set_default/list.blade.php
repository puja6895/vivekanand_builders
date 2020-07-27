@extends('layouts.home')

@section('title','Set Default')


@section('Set Default')
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
            <li class="breadcrumb-item active">  Default Product</li>
            {{-- <li class="breadcrumb-item"><a href="#">Layout</a></li> --}}
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            @if (Session::get('success'))
              <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <strong>Success!</strong> {{Session::get('success')}}
              </div>
            @endif
            @if (Session::get('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Error!</strong> {{Session::get('error')}}
            </div>
          @endif
            <div class="card">
    <div class="card-header">
    <a href="{{route('default_product.add')}}" class="pull-right">
        <button class="btn btn-info"><b>Add New+</b></button>
    </a>
    </div>
    {{-- <div class="box">
        <div class="box-header">
          {{-- <h3 class="box-title">Customers</h3> --}}
          {{-- <a href="" class="pull-right">
              <button class="btn btn-info"><b>Add New+</b></button>
          </a>
        </div> --}} 
    <!-- /.card-header -->
    <div class="card-body">
      <div class="table-responsive">

      
      <table id="example1" class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
          <th>Product Name</th>
          <th>Unit Name</th>
          <th>Sell Price</th>
          <th>Purchase Price</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
         @foreach($default_products as $default_product)
          <tr>
             
              <td>{{$default_product->product->product_name}}</td>
              <td>{{$default_product->unit->unit_name}}</td>
              <td><span><b><span>&#8377;</b></span> {{$default_product->sell_price}}</td>
              <td><span><b><span>&#8377;</b></span> {{$default_product->purchase_price}}</td>
              <td><a href="{{route('default_product.edit',['id'=>$default_product->default_product_id])}}"><button class="btn btn-sm btn-info">Edit</button></a></td>
          </tr>
         @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th>Product Name</th>
            <th>Unit Name</th>
            <th>Sell Price</th>
            <th>Purchase Price</th>
            <th>Action</th>
        </tr>
        </tfoot>
      </table>
    </div>
    </div>
    <!-- /.card-body -->
    </div>
            <!-- /.card -->
          </div>
        </div>    </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->

@endsection
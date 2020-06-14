@extends('layouts.home')

@section('title','Customers')


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
            <h3>
              Customers <small class="text-secondary" style="font-size: 50%">All customers</small>
            </h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Customer</li>
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
      <h3 class="card-title text-success text-bold">Active Customers</h3>
    <a href="{{route('customer.add')}}" class="pull-right">
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
          <th>Customer Name</th>
          <th>Mobile</th>
          <th>Email</th>
          <th>Address</th>
          <th>GST No</th>

          <th>Action</th>
        </tr>
        </thead>
        <tbody>
          @foreach($customers as $customer)
            <tr>
              <td>{{$customer->customer_name}}</td>
              <td>{{$customer->customer_mobile}}</td>
              <td>{{$customer->customer_email ? $customer->customer_email : 'N/A'}}</td>
              <td>{{$customer->customer_address ? $customer->customer_address : 'N/A'}}</td>
              <td>{{$customer->gst_no ? $customer->gst_no : 'N/A'}}</td>
              <td>
                <a href="{{route('customer.edit',['id'=>$customer->customer_id])}}"><button class="btn btn-info btn-sm text-white"><strong>Edit</strong></button></a>
                <a href="{{route('customer.destroy',['id'=>$customer->customer_id])}}"><button class="btn btn-danger btn-sm text-white"><strong>Disable</strong></button></a>

              </td>
            
              </tr>
          @endforeach    
        </tbody>
        <tfoot>
        <tr>
            <th>Customer Name</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Address</th>
            <th>GST No</th>
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
        </div><hr>

        {{-- Disabled Customers --}}
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            
            <div class="card">
    <div class="card-header">
      <h3 class="card-title text-danger text-bold">Inactive Customers</h3>
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

      
      <table id="example2" class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
          <th>Customer Name</th>
          <th>Mobile</th>
          <th>Email</th>
          <th>Address</th>
          <th>GST No</th>

          <th>Action</th>
        </tr>
        </thead>
        <tbody>
          @foreach($customers_disabled as $customer)
            <tr>
              <td>{{$customer->customer_name}}</td>
              <td>{{$customer->customer_mobile}}</td>
              <td>{{$customer->customer_email ? $customer->customer_email : 'N/A'}}</td>
              <td>{{$customer->customer_address ? $customer->customer_address : 'N/A'}}</td>
              <td>{{$customer->gst_no ? $customer->gst_no : 'N/A'}}</td>
              <td>
                <a href="{{route('customer.enable',['id'=>$customer->customer_id])}}"><button class="btn btn-success btn-sm text-white"><strong>Enable</strong></button></a>

              </td>
            
              </tr>
          @endforeach    
        </tbody>
        <tfoot>
        <tr>
            <th>Customer Name</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Address</th>
            <th>GST No</th>
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
        </div>
      </div>
    </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->

@endsection
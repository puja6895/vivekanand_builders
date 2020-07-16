@extends('layouts.home')

@section('title','Sales')

@section('Sell')
    active    
@endsection

@section('content')
{{-- {{print_r($sells)}}
              {{dd()}} --}}
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h3>
            {{($sell->customer->customer_name)}}
            <small class="text-secondary" style="font-size:1rem">(Sell Id -> {{$sell->sell_id}})</small>
            <h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{route('sell')}}">Sales</a></li>
            <li class="breadcrumb-item active">Sales Detail</li>
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
                <h3 class="card-title text-secondary">Sales Detail</h3>
              <a href="{{route('sell')}}" class="pull-right">
                <input
                action="action"
                onclick="window.history.go(-1); return false;"
                type="submit"
                value="Back"
                class="btbn btn-info pull-right">
              </a>
              
              </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped table-hover ">
                      <thead>
                      <tr>
                        {{-- <th>Customer Name</th> --}}
                        {{-- <th>Sell Id</th> --}}
                        <th>Sell Date</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        {{-- <th>Unit</th> --}}
                        <th>Rate</th>
                        <th>GST%</th>
                        <th>Amount</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($sell->sell_products as $sell_product)
                         <tr>
                         {{-- <td>{{$sell_product->sell_id}}</td> --}}
                         <td>{{$sell->sell_date}}</td>
                         <td>{{$sell_product->product->product_name}}</td>
                         <td>{{$sell_product->quantity}}({{$sell_product->unit_name}})</td>
                         {{-- <td></td> --}}
                         <td>{{$sell_product->rate}}</td>
                         <td>{{$sell_product->gst}}</td>
                         <td>{{$sell_product->amount}}</td>
                         </tr>
                       @endforeach   
                      </tbody>
                      <tfoot>
                        <tr>
                          {{-- <th>Sell Id</th> --}}
                          <th>Sell Date</th>
                          <th>Product Name</th>
                          <th>Quantity</th>
                          <th>Rate</th>
                          <th>GST%</th>
                          <th>Amount</th>
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
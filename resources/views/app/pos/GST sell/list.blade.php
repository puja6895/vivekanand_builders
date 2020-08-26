@extends('layouts.home')

@section('title','GST Sales')

@section('GST Sell')
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
            <h3>Sales</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Sales</li>
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
                <h3 class="card-title text-secondary mr-4">Sales</h3>
                <a href="{{route('gstpayment.add')}}" class="pull-right">
                  <button class="btn btn-success"><b>Add Payment</b></button>
                </a>
                <a href="{{route('gst_sell.add')}}" class="pull-right">
                    <button class="btn btn-info mr-3"><b>Add New+</b></button>
                </a>
                <input type="text" name="date" id="datepicker" class="form-inline datepicker list_date" placeholder="Select Date...">
              </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped table-hover">
                      <thead>
                      <tr>
                        <th>Customer Name</th>
                        <th>Sell Id</th>
                        <th>Sell Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                         @foreach($gstsells as $gstsell)
                          <tr>
                            <td> <a href="{{route('gst_sell.individual',['id'=>$gstsell->customer_id])}}">{{$gstsell->customer->customer_name }}</a></td> 
                            <td><a href="{{route('sell.individual_sell',['id'=>$gstsell->id])}}">{{$gstsell->id}}</td>
                            <td>{{\Carbon\Carbon::parse($gstsell->sell_date)->format('d-m-Y')}}</td>
                            <td>{{$gstsell->total_amount}}</td>
                            @if($gstsell->status==0)
                            <td>
                              <span class="badge badge-warning">Not Billed</span>
                            </td>
                            @else
                            <td>
                              <span class="badge badge-success">Billed</span>
                            </td>
                            @endif
                            <td>
                            <a href="{{route('gstsell.destroy',['id'=>$gstsell->id])}}"><button class="btn  btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
                            </td>
                          </tr>
                        @endforeach 

                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Customer Name</th>
                          <th>Sell Id</th>
                          <th>Sell Date</th>
                          <th>Amount</th>
                          <th>Status</th>
                          <th>Action</th>
                          {{-- <th>Total Amount</th> --}}
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
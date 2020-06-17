@extends('layouts.home')

@section('title','Sales')

@section('Pos')
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
          <h3>{{$customer->customer_name}}</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{route('sell')}}">Sales</a></li>
            <li class="breadcrumb-item active">Individual_Customer</li>
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
                <h3 class="card-title text-secondary mr-4">Sell</h3>
              <a href="{{route('sell')}}" class="pull-right">
                <input
                action="action"
                onclick="window.history.go(-1); return false;"
                type="submit"
                value="Back"
                class="btbn btn-info pull-right"
            />
              </a>
              <input type="text" name="date" id="datepicker" class="form-inline datepicker" placeholder="Select Date...">
              </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped table-hover ">
                      <thead>
                      <tr>
                        {{-- <th>Customer Name</th> --}}
                        <th>Sell Id</th>
                        <th>Sell Date</th>
                        <th>Amount</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($customer->sells as $sell)
                         <tr>
                           <td><a href="{{route('sell.individual_sell',['id'=>$sell->sell_id])}}">{{$sell->sell_id}}</td>
                            <td>{{\Carbon\Carbon::parse($sell->sell_date)->format('d-m-Y')}}</td>
                         <td>{{$sell->total_amount}}</td>
                         </tr>
                       @endforeach  
                       {{-- <tr colspan="2">
                         Grand Total
                       </tr> 
                       <tr>
                         payment Received
                       </tr> --}}
                      </tbody>
                      <tfoot>
                        <tr>
                          {{-- <th>Customer Name</th> --}}
                        <th>Sell Id</th>
                        <th>Sell Date</th>
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
      </div><hr>

      {{-- Payment Detail --}}
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title text-success font-weight-bolder">Payment Detail</h3>
              <a href="{{route('payment.add')}}" class="pull-right">
                  <button class="btn btn-success"><b>Add Payment</b></button>
              </a>
              </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped table-hover ">
                      <thead>
                      <tr>
                      <th>Grand Total </th>
                      <th>{{$grand_total}}</th>
                      </tr>
                      <tr>
                      <th>Payment Received</th>
                      <th>{{$payment}}</th>
                      </tr>
                      <tr>
                        <th>Balance</th>
                        <th>{{$grand_total-$payment}}</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
      
      
    </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->
@endsection
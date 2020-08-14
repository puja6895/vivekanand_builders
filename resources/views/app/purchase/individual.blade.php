@extends('layouts.home')

@section('title','Purchase')

@section('Purchase')
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
          <h3>{{$purchaser->purchaser_name}}</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{route('sell')}}">Purchases</a></li>
            <li class="breadcrumb-item active">Individual_Purchaser</li>
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
          {{-- List Of Selected Date --}}
          <form action="" method="POST">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="form-group {{ $errors->has('sell_date') ? ' has-error' : '' }}">
                  {{-- <label>Sell Date <span style="color: red;">*</span></label> --}}
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="datepicker">
                        <i class="fa fa-calendar"></i>
                      </label>
                    </div>
                    <input type="text" name="from_date" class="form-control datepicker mr-3" id="datepicker" required="" placeholder="dd-mm-yyyy">
                    <input type="text" name="to_date" class="form-control datepicker mr-3" id="datepicker"  placeholder="dd-mm-yyyy">
                    <button class="btn btn-info">Submit</button>
                    {{-- @if ($errors->has('sell_date'))
                    <span class="help-block">
                        <strong>{{ $errors->first('sell_date') }}</strong>
                    </span>
                    @endif --}}
                  </div>
                </div>
              </div>
            </div>  
          </form>  
            <div class="card">
              <div class="card-header">
                <h3 class="card-title text-secondary mr-4">Purchase</h3>
              <a href="{{route('sell')}}" class="pull-right">
                <input
                action="action"
                onclick="window.history.go(-1); return false;"
                type="submit"
                value="Back"
                class="btn btn-info pull-right"
              />
              </a>
              <input type="text" name="date" id="datepicker" class="form-inline datepicker list_date" placeholder="Select Date...">
              </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped table-hover ">
                      <thead> 
                      <tr>
                        {{-- <th>Customer Name</th> --}}
                        <th>Purchase Date</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        {{-- <th>Unit</th> --}}
                        <th>Rate</th>
                        <th>GST%</th>
                        <th>Amount</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($purchases as $purchase)  

                      @foreach($purchase->purchase_products as $purchase_product)
                         <tr>
                            {{-- <td><a href="{{route('sell.individual_sell',['id'=>$sell->sell_id])}}">{{$sell->sell_id}}</td> --}}
                            <td>{{\Carbon\Carbon::parse($purchase->purchase_date)->format('d-m-Y')}}</td>
                            <td>{{$purchase_product->product->product_name}}</td>
                            <td>{{$purchase_product->quantity}}({{$purchase_product->unit->unit_name}})</td>
                            <td>{{$purchase_product->rate}}</td>
                            <td>{{$purchase_product->gst}}</td>
                            <td>{{$purchase_product->amount}}</td>
                            {{-- <td>{{$sell[0]->total_amount}}</td> --}}
                        <tr>
                          @endforeach 
                          @endforeach
                        <tfoot>
                          <tr>
                            <th>Purchase Date</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            {{-- <th>Unit</th> --}}
                            <th>Rate</th>
                            <th>GST%</th>
                            <th>Amount</th>
                          </tr>
                        </tfoot>    
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
                    <table id="" class="table table-bordered table-striped table-hover ">
                      <thead>
                      <tr>
                      <th>Grand Total </th>
                      <th>{{$grand_total}}</th>
                      </tr>
                      <tr>
                      <th>Payment</th>
                      {{-- {{dd($payment)}} --}}
                      <th>{{$payment}}</th>
                      
                      </tr>
                      <tr>
                        <th>Balance</th>
                        <th>{{$grand_total - $payment}}</th>
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
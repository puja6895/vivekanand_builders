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
            <h3>Purchase</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Purchase</li>
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
                <a href="{{route('payment.add')}}" class="pull-right">
                  <button class="btn btn-success"><b>Add Payment</b></button>
                </a>
                <a href="{{route('purchase.add')}}" class="pull-right">
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
                        <th>Purchaser Name</th>
                        <th>Purchase Id</th>
                        <th>Purchase Date</th>
                        <th>Amount</th>
                        {{-- <th>Status</th> --}}
                      </tr>
                      </thead>
                      <tbody>
                         @foreach($purchases as $purchase)
                          <tr>
                            <td> <a href="{{route('purchase.individual',['id'=>$purchase->purchaser_id])}}">{{$purchase->purchasers->purchaser_name }}</a></td> 
                            {{-- {{dd($purchase->purchasers->purchaser_name)}} --}}
                            <td><a href="{{route('sell.individual_sell',['id'=>$purchase->purchase_id])}}">{{$purchase->purchase_id}}</td>
                            <td>{{\Carbon\Carbon::parse($purchase->purchase_date)->format('d-m-Y')}}</td>
                            <td>{{$purchase->total_amount}}</td>
                            {{-- @if($purchase->status==0)
                            <td>
                              <span class="badge badge-warning">Not Billed</span>
                            </td>
                            @else
                            <td>
                              <span class="badge badge-success">Billed</span>
                            </td>
                            @endif --}}
                          </tr>
                        @endforeach 
                      </tbody>
                      <tfoot>
                        <tr>
                            <th>Purchaser Name</th>
                            <th>Purchase Id</th>
                            <th>Purchase Date</th>
                            <th>Amount</th>
                            {{-- <th>Status</th> --}}
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
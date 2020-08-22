@extends('layouts.home')
@section('title','Clients List')

@section('Clients')
    active    
@endsection

@section('Clients Clients List')
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
            <h3>Customers List</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Customers</li>
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
          <table class="table table-borderless" >
            <thead>
              <tr class="text-primary text-center">
                <td><b>Total Sell Amount</b></td>
                <td><b>Amount Pay Received</b></td>
                <td><b>Due Amount</b></td>
              </tr>
            </thead>
            <tbody>
              <tr class="text-center">
                <td><b> <h1><span style="font-size: 50px;">&#8377;</span> {{$sell_total_amount}}</h1></b></td>
                <td class="text-success"><b><h1><span style="font-size: 50px;">&#8377;</span> {{$payment_total_amount}}</h1></b></td>
                <td class="text-danger"><b><h1><span style="font-size: 50px;">&#8377;</span> {{$total_due_amount}}</h1></b></td>
              </tr>
            </tbody>
          </table>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title text-secondary">Customers</h3>
              {{-- <a href="{{route('category.add')}}" class="pull-right">
                  <button class="btn btn-info"><b>Add New+</b></button>
              </a> --}}
              </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped table-hover ">
                      <thead>
                      <tr>
                        <th>Customer Name</th>
                        <th>Total Amount</th>
                        <th>Total Payment</th>
                        <th>Due Amount</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                        {{-- @php 
                          $due_amount
                        @endphp --}}
                        @foreach($lists as $list)
                        @if(($list->total_payment == NULL ? $list->total_amount - 0: $list->total_amount - $list->total_payment)>0)
                               @php
                                  $previous_due = $list->previous_due_amount;
                                  $total_amount = $list->total_amount +  $previous_due;
                               @endphp 
                          <tr>
                            <td> <a href="{{route('sell.individual',[$list->customer_id])}}">{{ $list->customer_name}}</a></td>
                            <td><span style="font-size: 17px;">&#8377;</span> {{ $total_amount}}</td>
                            <td><span style="font-size: 17px;">&#8377;</span> {{ $list->total_payment == NULL ? 0:$list->total_payment}}</td>
                            <td><span style="font-size: 17px;">&#8377;</span> {{ $list->total_payment == NULL ? $total_amount - 0: $total_amount - $list->total_payment}}</td>
                            <td>
                                <a href="{{route('sell.individual',[$list->customer_id])}}"><button class="btn btn-sm btn-info">View</button></a>
                            </td>
                          </tr>
                          @endif
                        @endforeach                      
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Customer Name</th>
                        <th>Total Amount</th>
                        <th>Total Payment</th>
                        <th>Due Amount</th>
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
     
 
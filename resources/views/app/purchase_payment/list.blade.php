@extends('layouts.home')

@section('title','Payment')


@section('Payment')
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
             Payments
            </h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Payments</li>
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
    <a href="{{route('purchase_payment.add')}}" class="pull-right">
        <button class="btn btn-success"><b>Add New+</b></button>
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
          <th>Purchaser Name</th>
          <th>Paid Date</th>
          <th>Paid Mode</th>
          <th>Debit Discount</th>
          <th>Credit Discount</th>
          <th>Paid Amount</th>
          <th>Freight</th>
          <th>Final Amount</th>
        </tr>
        </thead>
        <tbody>
         @foreach($payments as $payment)
          <tr>
            <td>

              <a href="{{route('purchase.individual',['id'=>$payment->purchaser_id])}}">{{$payment->purchaser->purchaser_name}}</a>
            </td>
              <td>{{$payment->paid_date}}</td>
              <td>{{$payment->paid_mode}}</td>
              <td>{{$payment->debit}}</td>
              <td>{{$payment->credit}}</td>
              <td>{{$payment->paid}}</td>
              <td>{{$payment->freight}}</td>
              <td>{{$payment->final_paid}}</td>
          </tr>
         @endforeach
        </tbody>
        <tfoot>
        <tr>
          <th>Purchaser Name</th>
          <th>Paid Date</th>
          <th>Paid Mode</th>
          <th>Debit Discount</th>
          <th>Credit Discount</th>
          <th>Paid Amount</th>
          <th>Freight</th>
          <th>Final Amount</th>
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
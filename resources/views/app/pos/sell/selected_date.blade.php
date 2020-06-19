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
            <li class="breadcrumb-item active">Sales</li>
            {{-- <li class="breadcrumb-item"><a href="#">Layout</a></li> --}}
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div class='row ml-3'>
    {{-- <h4 class=" text-primary mr-3">From:<small class="ml-2 text-muted">{{\Carbon\Carbon::parse($from_date)->format('d-m-Y')}}</small></h4><br> --}}
    {{-- <h4 class=" text-primary">To:<small class="ml-2 text-muted">{{\Carbon\Carbon::parse($to_date)->format('d-m-Y')}}</small></h4> --}}

    </div>
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
              <h3 class="card-title text-secondary mr-4">Summary of <strong>{{\Carbon\Carbon::parse($from_date)->format('F, Y')}}</strong></h3>
                {{-- <a href="{{route('sell')}}" class="pull-right"> --}}
                    <input
                        action="action"
                        onclick="window.history.go(-1); return false;"
                        type="submit"
                        value="Back"
                        class="btn btn-info pull-right"
                    />
              </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="" class="table table-bordered table-striped table-hover">
                      <thead>
                      <tr>
                        <th>Opening Balance</th>
                        <th>Total Amount</th>
                        <th>Payment Rreceived</th>
                        <th>Closing Balance</th>
                        {{-- <th>Sell Date</th>
                        <th>Amount</th> --}}
                      </tr>
                      </thead>
                      <tbody>
                          <tr>
                          <td>{{$opening1[0]->opening1 - $opening2[0]->opening2}}</td>
                          <td>{{$total_amount[0]->total_amount }}</td>
                          <td>{{$total_payamount[0]->total_payamount}}</td>
                          <td>{{$total_amount[0]->total_amount - $total_payamount[0]->total_payamount}}</td>
                          </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Opening Balance</th>
                            <th>Total Amount</th>
                            <th>Payment Rreceived</th>
                            <th>Closing Balance</th>
                          {{-- <th>Sell Date</th>
                          <th>Amount</th> --}}
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
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
                <h3 class="card-title text-secondary">Sales</h3>
              <a href="{{route('sell.add')}}" class="pull-right">
                  <button class="btn btn-info"><b>Add New+</b></button>
              </a>
              
              </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped table-hover ">
                      <thead>
                      <tr>
                        <th>Customer Name</th>
                        <th>Sell Id</th>
                        <th>Sell Date</th>
                        <th>Amount</th>
                      </tr>
                      </thead>
                      <tbody>
                         @foreach($sells as $sell)
                          <tr>
                            <td> <a href="{{route('sell.individual',['id'=>$sell->customer_id])}}">{{$sell->customer->customer_name }}</a></td> 
                            <td><a href="{{route('sell.individual_sell',['id'=>$sell->sell_id])}}">{{$sell->sell_id}}</td>
                            <td>{{$sell->sell_date}}</td>
                            {{-- <td></td> --}}
                            <td>{{$sell->total_amount}}</td>
                          </tr>
                        @endforeach 
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Customer Name</th>
                          <th>Sell Id</th>
                          <th>Sell Date</th>
                          <th>Amount</th>
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
      </div><hr>
    </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->
@endsection
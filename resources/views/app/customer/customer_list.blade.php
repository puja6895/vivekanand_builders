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
                        @foreach($lists as $list)
                          <tr>
                            <td>{{ $list->customer_name}}</td>
                            <td><span style="font-size: 17px;">&#8377;</span> {{ $list->total_amount}}</td>
                            <td><span style="font-size: 17px;">&#8377;</span> {{ $list->total_payment == NULL ? 0:$list->total_payment}}</td>
                            <td><span style="font-size: 17px;">&#8377;</span> {{ $list->total_payment == NULL ? $list->total_amount - 0: $list->total_amount - $list->total_payment}}</td>
                            <td>
                                <a href="{{route('sell.individual',[$list->customer_id])}}"><button class="btn btn-sm btn-info">View</button></a>
                            </td>
                          </tr>
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
     
 
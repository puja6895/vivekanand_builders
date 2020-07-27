@extends('layouts.home')

@section('title','Invoice')


@section('Invoice List ')
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
                        Invoice List
                    </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
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
                    @if(Session::get('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Success!</strong> {{ Session::get('success') }}
                        </div>
                    @endif
                    @if(Session::get('error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Error!</strong> {{ Session::get('error') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('invoice.add') }}" class="pull-right">
                                <button class="btn btn-info"><b>Generate Invoice</b></button>
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
                                            <th>Customer Name</th>
                                            <th>Admin Name</th>
                                            <th>Bill Date</th>
                                            <th>Bill Number</th>
                                            <th>Bill Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bill_details as $bill_detail)
                                            <tr>
                                                <td>{{ $bill_detail->customer->customer_name }}</td>
                                                <td>{{ $bill_detail->admin->admin_name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($bill_detail->bill_date)->format('d-m-Y') }}
                                                <td>{{ $bill_detail->bill_no }}</td>
                                                </td>
                                                <td>{{ $bill_detail->amount }}</td>
                                                <td><a
                                                        href="{{ route('invoice.view',['bill_id'=>$bill_detail->bill_id]) }}"><button
                                                            class="btn btn-sm btn-info">View</button></a>

                                                        <a href="{{route('invoice.destroy',['bill_id'=>$bill_detail->bill_id])}}"><button class="btn btn-sm btn-danger">Delete</button></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Admin Name</th>
                                            <th>Bill Date</th>
                                            <th>Bill Number</th>
                                            <th>Bill Amount</th>
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
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection



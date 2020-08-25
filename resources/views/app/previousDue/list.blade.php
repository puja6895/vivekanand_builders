@extends('layouts.home')

@section('title',' Previous Due')

@section(' Previous Due')
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
            <h3>Previous Due</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Previous Due</li>
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
                <h3 class="card-title text-secondary">Lorry</h3>
              <a href="{{route('previousdue.add')}}" class="pull-right">
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
                        <th>Date</th>
                        <th>Previous Due Amount</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach($lists as $list)
                          <tr>
                            <td>{{$list->customer->customer_name}}</td>
                            <td>{{\Carbon\Carbon::parse($list->previous_due_date)->format('d-m-Y')}}</td>
                            <td>{{$list->previous_due_amount}}</td>
                          </tr>
                        @endforeach                            
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Customer Name</th>
                        <th>Date</th>
                        <th>Previous Due Amount</th>
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
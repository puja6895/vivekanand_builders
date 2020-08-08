@extends('layouts.home')

@section('title','Inventory')

@section('Inventory')
    active    
@endsection

@section('Inventory Inventory Log')
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
            <h3>Inventory</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Inventory</li>
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
                <h3 class="card-title text-secondary">Inventory</h3>
              <a href="{{route('inventory.add')}}" class="pull-right">
                  <button class="btn btn-info"><b>Add New+</b></button>
              </a>
              </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped table-hover ">
                        <thead>
                            <tr>
                              <th>Date</th>
                              <th>Product Name</th>
                              <th>Quantity</th>
                              <th>Status</th> 
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($inventories as  $inv)
                            <tr>
                              <td>{{\Carbon\Carbon::parse($inv->date)->format('d-m-Y')}}</td>
                              <td>{{$inv->product->product_name}}</td>
                              <td>{{$inv->quantity}} ({{$inv->unit->unit_name}})</td>
                              <td>
                                  @if($inv->quantity> 10)
                                      <label class="badge badge-success">In Stock</label>
                                  @elseif($inv->quantity < 10 && $inv->quantity > 0)
                                      <label class="badge badge-warning">Low Stock</label>
                                  @elseif($inv->quantity < 1)
                                  <label class="badge badge-danger">Out Of Stock</label>
                                  @endif
                              </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                              <th>Date</th>
                              <th>Product Name</th>
                              <th>Quantity</th>
                              <th>Status</th>
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
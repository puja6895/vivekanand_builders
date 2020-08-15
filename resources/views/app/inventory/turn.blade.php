@extends('layouts.home')

@section('title','Inventory')

@section('Inventory')
    active    
@endsection

@section('Inventory Inventory Turn')
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
          <form action="{{route('inventory.turn_list')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div
                        class="form-group {{ $errors->has('from_date') ? ' has-error' : '' }}">
                        {{-- <label>Sell Date <span style="color: red;">*</span></label> --}}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="datepicker">
                                    <i class="fa fa-calendar"></i>
                                </label>
                            </div>
                            <input type="text" name="from_date" class="form-control datepicker mr-3"
                                id="datepicker" placeholder="dd-mm-yyyy">
                            {{-- <input type="text" name="to_date" class="form-control datepicker mr-3"
                                id="datepicker" placeholder="dd-mm-yyyy"> --}}
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
          </form>
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
                              <th>Product Name</th>
                              <th>Opening</th>
                              <th>Purchase</th>
                              <th>Sell</th>
                              <th>Closing</th> 
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lists as  $list)
                            @php 
                              $invent = !empty($list->total_invent) ? $list->total_invent : 0;
                              $purchase = !empty($list->total_purchase) ? $list->total_purchase : 0;
                              $sell = !empty($list->total_sell) ? $list->total_sell : 0;
                              $opening = ($invent + $purchase) - $sell;
                              $closing = ($opening + $list->purchase_quantity + $list->inventory_quantity ) - $list->sell_quantity;
                            @endphp
                            <tr>
                              <td>{{$list->product_name}}</td>
                              <td>{{$opening}}</td>
                              <td>{{$list->purchase_quantity}}</td>
                              <td>{{$list->sell_quantity}}</td>
                              <td>{{$closing}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                              <th>Product Name</th>
                              <th>Opening</th>
                              <th>Purchase</th>
                              <th>Sell</th>
                              <th>Closing</th> 
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
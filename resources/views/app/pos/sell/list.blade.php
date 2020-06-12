@extends('layouts.home')

@section('title','Sales')

@section('Product')
    active    
@endsection

@section('content')
{{print_r($sells)}}
              {{dd()}}
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Sells</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Sells</li>
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
                <h3 class="card-title text-secondary">Products</h3>
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
                        <th>Sell Date</th>
                        <th>Amount</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach($sells as $sell)
                          <tr>
                            <td>{{$sell->customer_id}}</td> 
                            <td>{{$sell->sell_date}}</td>
                            <td>{{$sell->total_amount}}</td>
                            {{-- <td>
                              @if($product->deleted_at==null)   
                                <a href="{{route('product.edit',['id'=>$product->product_id])}}" class="mr-2"><button class="btn btn-info btn-sm">Edit</button></a>
                                <a href="{{route('product.destroy',['id'=>$product->product_id])}}"><button class="btn btn-danger btn-sm">Disable</button></a>
                              @else
                                <a href="{{route('product.enable',['id'=>$product->product_id])}}"><button class="btn btn-success btn-sm">Enable</button></a>
                              @endif
                            </td> --}}
                          </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Customer Name</th>
                        <th>Sell Date</th>
                        <th>Amount</th>
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
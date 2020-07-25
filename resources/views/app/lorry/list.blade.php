@extends('layouts.home')

@section('title','Lorry')

@section('Lorry')
    active    
@endsection

{{-- @section('Master-unit')
    active    
@endsection --}}

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Lorry</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Lorry</li>
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
              <a href="{{route('lorry.add')}}" class="pull-right">
                  <button class="btn btn-info"><b>Add New+</b></button>
              </a>
              </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped table-hover ">
                      <thead>
                      <tr>
                        <th>Lorry Name</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach($lorries as $lorry)
                          <tr>
                          <td>{{$lorry->lorry_no}}</td>
                          <td>
                            @if($lorry->deleted_at==null)   
                            <a href="{{route('lorry.edit',['id'=>$lorry->lorry_id])}}" class="mr-2"><button class="btn btn-info btn-sm">Edit</button></a>
                            <a href="{{route('lorry.destroy',['id'=>$lorry->lorry_id])}}"><button class="btn btn-danger btn-sm">Disable</button></a>
                          @else
                          <a href="{{route('lorry.enable',['id'=>$lorry->lorry_id])}}"><button class="btn btn-success btn-sm">Enable</button></a>
                          @endif
                          </td>
                          </tr>
                        @endforeach                            
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Lorry Name</th>
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
@extends('layouts.home')
@section('title','Categories')

@section('Master')
    active    
@endsection

@section('Master-categories')
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
            <h3>Categories</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Categories</li>
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
                <h3 class="card-title text-secondary">Categories</h3>
              <a href="{{route('category.add')}}" class="pull-right">
                  <button class="btn btn-info"><b>Add New+</b></button>
              </a>
              </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped table-hover ">
                      <thead>
                      <tr>
                        <th>Category Name</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach($categories as $category)
                          <tr>
                          <td>{{$category->category_name}}</td>
                          <td>
                            @if($category->deleted_at==null)   
                              <a href="{{route('category.edit',['id'=>$category->category_id])}}" class="mr-2"><button class="btn btn-info btn-sm">Edit</button></a>
                              <a href="{{route('category.destroy',['id'=>$category->category_id])}}"><button class="btn btn-danger btn-sm">Disable</button></a>
                            @else
                              <a href="{{route('category.enable',['id'=>$category->category_id])}}"><button class="btn btn-success btn-sm">Enable</button></a>
                            @endif
                          </td>
                          </tr>
                        @endforeach                      
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Categorie Name</th>
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
     
 
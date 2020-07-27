@extends('layouts.home')

@section('title','Invoice')

@section('Generate Invoice')
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
            <h3> Invoice</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Invoice</li>
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
                <h3 class="card-title text-secondary">Invoice</h3>
              {{-- <a href="" class="pull-right">
                  <button class="btn btn-info"><b>Add New+</b></button>
              </a> --}}
              </div>
                <!-- /.card-header -->
                <div class="card-body">
                  {{-- {{dd($customers[0])}} --}}
                <form action="{{route('invoice.store')}}" method = "POST">
                    @csrf
                    <div class="row">
                        {{-- Sell To Name --}}
                        <div class="col">
                          <div class="form-group {{ $errors->has('customer_id') ? ' has-error' : '' }}">
                            <label>Customer <span style="color: red;">*</span></label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <label class="input-group-text" for="customer_id">
                                    <i class="fa fa-user"></i>
                                </label>
                              </div>
                              <select required class="form-control" id="customer_id" name="customer_id">
                                <option selected="" disabled="">Select Customer</option>
                                @foreach($customers as $customer)
                              <option value="{{$customer->customer_id}}">{{$customer->customer_name}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                    </div>

                    <div class="row">
                      {{-- Sell To Name --}}
                      <div class="col">
                        <div class="form-group {{ $errors->has('admin_id') ? ' has-error' : '' }}">
                          <label>Admin <span style="color: red;">*</span></label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="admin_id">
                                  <i class="fa fa-user"></i>
                              </label>
                            </div>
                            <select required class="form-control" id="admin_id" name="admin_id">
                              <option selected="" disabled="">Select Admin</option>
                              @foreach($admins as $admin)
                            <option value="{{$admin->admin_id}}">{{$admin->admin_name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--FROM DATE  -->
                    <div class="row">
                        <div class="col">
                            <div class="form-group {{ $errors->has('from_date') ? ' has-error' : '' }}">
                              <label>From Date <span style="color: red;">*</span></label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <label class="input-group-text" for="datepicker">
                                    <i class="fa fa-calendar"></i>
                                  </label>
                                </div>
                                <input type="text" name="from_date" class="form-control datepicker list_date" id="datepicker" required="" placeholder="dd-mm-yyyy">
                                @if ($errors->has('from_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('from_date') }}</strong>
                                </span>
                                @endif
                              </div>
                            </div>
                        </div>
                    </div>
                    {{-- TO DATE --}}
                    <div class="row">
                        <div class="col">
                            <div class="form-group {{ $errors->has('to_date') ? ' has-error' : '' }}">
                              <label>To Date <span style="color: red;">*</span></label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <label class="input-group-text" for="datepicker">
                                    <i class="fa fa-calendar"></i>
                                  </label>
                                </div>
                                <input type="text" name="to_date" class="form-control datepicker list_date" id="datepicker" required="" placeholder="dd-mm-yyyy">
                                @if ($errors->has('sell_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('to_date') }}</strong>
                                </span>
                                @endif
                              </div>
                            </div>
                        </div>
                    </div>
                        <button class="btn btn-success" type="submit">Generate Invoice</button>
                </form>
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

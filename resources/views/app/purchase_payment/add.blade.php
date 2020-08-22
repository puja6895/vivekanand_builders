@extends('layouts.home')

@section('title','Payment | Add')

@section('Payment')
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
                Payment
            </h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item "><a href="{{route('purchase_payments')}}">Payment</a></li>
              {{-- <li class="breadcrumb-item "><a href="">Individal_Customer</a></li> --}}
              <li class="breadcrumb-item active">PayAdd</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            @foreach ($errors->all() as $error)
                @if ($error)
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Error!</strong> {{ $error }}
                    </div>
                @endif
            @endforeach

            
            <div class="card card-muted">
              <div class="card-header">
                <h3 class="card-title text-secondary">Add Payment </h3>
              <a href="{{route('payments')}}">
                <input
                action="action"
                onclick="window.history.go(-1); return false;"
                type="submit"
                value="Back"
                class="btn btn-info pull-right">
              </a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" id="quickForm" method="post" action="{{route('purchase_payment.store')}}" >
                @csrf
                <div class="card-body">
                    <div class="row">
                        {{-- Sell To Name --}}
                        <div class="col-md-6">
                          <div class="form-group {{ $errors->has('purchaser_id') ? ' has-error' : '' }}">
                            <label>Purchaser <span style="color: red;">*</span></label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <label class="input-group-text" for="purchaser_id">
                                    <i class="fa fa-user"></i>
                                </label>
                              </div>
                              <select required class="form-control" id="purchaser_id" name="purchaser_id">
                                <option selected="" disabled="">Select Purchaser</option>
                                @foreach($purchasers as $purchaser)
                                <option value="{{$purchaser->purchaser_id}}">{{$purchaser->purchaser_name}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('purchase_date') ? ' has-error' : '' }}">
                              <label>Paid Date <span style="color: red;">*</span></label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <label class="input-group-text" for="datepicker">
                                    <i class="fa fa-calendar"></i>
                                  </label>
                                </div>
                                <input type="text" name="paid_date" class="form-control datepicker" id="datepicker" required="" placeholder="dd-mm-yyyy">
                                @if ($errors->has('paid_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('paid_date') }}</strong>
                                </span>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Paid <span style="color: red;">*</span></label>
                            <input type="number" name="paid" class="form-control {{$errors->has('paid') ? 'is-invalid' : ''}}" id="paid" required="" placeholder="Enter Paid Amount" value="{{ old('paid')}}">
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Payment Mode <span style="color: red;">*</span></label>
                          <input type="text" name="paid_mode" class="form-control {{$errors->has('paid_mode') ? 'is-invalid' : ''}}" id="paid_mode" required="" placeholder="Enter Payment Mode" value="{{ old('paid_mode')}}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Debit Discount </label>
                        <input type="text" name="debit" class="form-control {{$errors->has('debit') ? 'is-invalid' : ''}}" id="debit"  placeholder="Enter Debit Discount" value = 0>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Credit Discount</label>
                        <input type="text" name="credit" class="form-control {{$errors->has('credit') ? 'is-invalid' : ''}}" id="credit"  placeholder="Enter Payment Mode" value = 0>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Freight</label>
                      <input type="text" name="freight" class="form-control {{$errors->has('freight') ? 'is-invalid' : ''}}" id="freight"  placeholder="Enter Payment Mode" value = 0>
                  </div>
                      
                    </div>
                <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Add Payment</button>
                        </div>
                </form>
            </div>
          </div>
        </div>
    </section>
            </div>
            <!-- /.card -->
          

    
@endsection
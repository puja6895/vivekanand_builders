@extends('layouts.home')

@section('title','Customers | Add')

@section('clients')
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
              <li class="breadcrumb-item "><a href="{{route('payments')}}">Payment</a></li>
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
            @if (Session::get('success'))
              <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <strong>Success!</strong> {{Session::get('success')}}
              </div>
            @endif
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
            <form role="form" id="quickForm" method="post" action="{{route('payment.store')}}" >
                @csrf
                <div class="card-body">
                    <div class="row">
                        {{-- Sell To Name --}}
                        <div class="col-md-6">
                          <div class="form-group {{ $errors->has('customer_id') ? ' has-error' : '' }}">
                            <label>Customer <span style="color: red;">*</span></label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <label class="input-group-text" for="customer_id">
                                    <i class="fa fa-user"></i>
                                </label>
                              </div>
                              <select required class="form-control" id="customer_id" name="customer_id">
                                {{-- {{dd($select_customer)}} --}}
                                @if(isset($select_customer))
                                {{-- {{dd($select_customer->customer_id)}} --}}
                                <option selected=""  value="{{$select_customer->customer_id}}">{{$select_customer->customer_name}}</option>
                                @elseif(isset($bills))
                                <option selected=""  value="{{$bills->customer_id}}">{{$bills->customer->customer_name}}</option>
                                @else
                                <option selected="" disabled="" >Select Customer</option>
                                @endif
                                @foreach($customers as $customer)
                                <option value="{{$customer->customer_id}}">{{$customer->customer_name}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('sell_date') ? ' has-error' : '' }}">
                              <label>Pay Date <span style="color: red;">*</span></label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <label class="input-group-text" for="datepicker">
                                    <i class="fa fa-calendar"></i>
                                  </label>
                                </div>
                                <input type="text" name="pay_date" class="form-control datepicker" id="datepicker" required="" placeholder="dd-mm-yyyy">
                                @if ($errors->has('sell_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('sell_date') }}</strong>
                                </span>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Payment Received <span style="color: red;">*</span></label>
                            {{-- {{dd()}} --}}
                            @if(isset($bills))
                            <input type="number" name="pay_received" class="form-control {{$errors->has('pay_received') ? 'is-invalid' : ''}}" id="pay_received"  placeholder="Enter Payment Received" value="{{ $bills->due_amount }}">
                            @else
                            <input type="number" name="pay_received" class="form-control {{$errors->has('pay_received') ? 'is-invalid' : ''}}" id="pay_received"  placeholder="Enter Payment Received" value="{{ old('pay_received') == null ? 0 : old('pay_received') }}">
                            @endif
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Payment Mode <span style="color: red;">*</span></label>
                          <input type="text" name="pay_mode" class="form-control {{$errors->has('pay_mode') ? 'is-invalid' : ''}}" id="pay_mode" required="" placeholder="Enter Payment Mode" value="{{ old('pay_mode')}}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1"><div class="form-group">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="for_bill" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                             For Bill
                            </label>
                          </div>
                        </div> </label>
                        <select required class="form-control" id="bill_id" name="bill_id">
                          {{-- <option selected="" disabled="">Select Bill Number</option> --}}
                          @if(isset($bills))
                          <option selected="" disabled="" value="{{$bills->bill_id}}">{{$bills->bill_no}}</option>
                          @else
                          <option selected  value="-1">Select Bill Number</option>
                          @endif
                          @foreach($bill_details as $bill_detail)
                          <option value="{{$bill_detail->bill_id}}">{{$bill_detail->bill_no}}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="card bg-light">
                      <div class="card-header">
                        <h5 class="card-title ">Discount</h5>
                      </div>
                      <div class="card-body">
                        <section>
                          <div class="form-group">
                            <label for="discount_amount">Discount Amount </label>
                            <input type="text" name="discount_amount" class="form-control {{$errors->has('discount_amount') ? 'is-invalid' : ''}}" id="discount_amount"  placeholder="Enter Discount Amount" value="{{ old('discount_amount')}}">
                          </div>
  
                          <div class="form-group">
                            <label for="description">Description</label>
                            <textarea  name="description" class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" id="description"  placeholder="Give Description..." value="{{ old('description')}}"></textarea>
                          </div>
                      </section>
                      </div>
                    </div>
                    
                <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Add Payment</button>
                        </div>
                </form>
            </div>
          </div>
        </div>
    </section>
            </div>
            <!-- /.card -->
          

    
@endsection
@section('scripts')
<script>
  defaultDate()
</script> 
@endsection 
@extends('layouts.home')

@section('title','Sales')

@section('Sell')
active
@endsection

@section('content')
{{-- {{print_r($sells) }}
{{ dd() }} --}}
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>{{ $customer->customer_name }}</h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('sell') }}">Sales</a>
                        </li>
                        <li class="breadcrumb-item active">Individual_Customer</li>
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
                    <table class="table table-borderless">
                        <thead>
                          <tr class="text-primary text-center ">
                            <td><b>Grand Total</b></td>
                            <td><b>Total Pay Received</b></td>
                            <td><b>Balance</b></td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="text-center ">
                            <td><b> <h1><span style="font-size: 50px;">&#8377;</span> {{ $grand_total + $previous_due}}</h1></b></td>
                            <td class="text-success"><b><h1><span style="font-size: 50px;">&#8377;</span> {{$payment}}</h1></b></td>
                            <td class="text-danger"><b><h1><span style="font-size: 50px;">&#8377;</span> {{ ($grand_total +  $previous_due) - $payment }}</h1></b></td>
                          </tr>
                        </tbody>
                      </table>
                    {{-- List Of Selected Date --}}
                        <form action="{{ route('sell.selected_date',['customer_id'=>$customer->customer_id]) }}"  method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div
                                    class="form-group {{ $errors->has('sell_date') ? ' has-error' : '' }}">
                                    {{-- <label>Sell Date <span style="color: red;">*</span></label> --}}
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="datepicker">
                                                <i class="fa fa-calendar"></i>
                                            </label>
                                        </div>
                                        <input type="text" name="from_date" class="form-control datepicker mr-3"
                                            id="datepicker" required="" placeholder="dd-mm-yyyy">
                                        <input type="text" name="to_date" class="form-control datepicker mr-3"
                                            id="datepicker" placeholder="dd-mm-yyyy">
                                        <button class="btn btn-info">Submit</button>
                                        {{-- @if ($errors->has('sell_date'))
                    <span class="help-block">
                        <strong>{{ $errors->first('sell_date') }}</strong>
                                        </span>
                                        @endif--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-secondary mr-4">Sell</h3>
                            <a href="{{ route('sell') }}" class="pull-right">
                                <input action="action" onclick="window.history.go(-1); return false;" type="submit"
                                    value="Back" class="btn btn-info pull-right" />
                            </a>
                          
                            <a href="{{ route('payment.ad' ,['customer_id'=>$customer->customer_id]) }}" class="pull-right">
                                <button class="btn btn-success mr-2"><b>Add Payment</b></button>

                            <a href="{{route('sell.add')}}"><button class = "btn btn-info pull-right mr-2">Add Sell+</button></a>

                                  <!-- Modal Button -->
                            <button type="button" class = "btn btn-info pull-right mr-2"  data-toggle="modal" data-target="#myModal">
                               Payment Detail
                            </button>

                            <input type="text" name="date" id="datepicker" class="form-inline datepicker list_date"
                                placeholder="Select Date...">

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="card-body">
                                {{-- Last Sell Modal --}}
                                <br>
                                <div class="modal fade" id="myModal">
                                  <div class="modal-dialog modal-dialog-centered">
                                      <div class="modal-content">
                          
                                          <!-- Modal Header -->
                                          <div class="modal-header">
                                              <h5 class="modal-title">Payment Detail</h5>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          </div>
                          
                                          <!-- Modal body -->
                                          {{-- <form action="add.php" method="post" enctype="multipart/form-data"> --}}
                                            <div class="table-responsive">
                                                <table id="example1" class="table table-bordered table-striped table-hover text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>Payment Date</th>
                                                            <th>Payment Received</th>
                                                            <th>mode</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($date_payments as $date_payment)
                                                                <tr>
                                                                    <td>{{ \Carbon\Carbon::parse($date_payment->pay_date)->format('d-m-Y') }}
                                                                    </td>
                                                                    <td>{{ $date_payment->pay_received }}</td>
                                                                    <td>{{ $date_payment->pay_mode }}</td>
                                                                 </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Payment Date</th>
                                                            <th>Payment Received</th>
                                                            <th>mode</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                          
                                             
                                          {{-- </form> --}}
                          
                                      </div>
                                  </div>
                              </div>
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>Sell Date</th>
                                            <th>Product name</th>
                                            <th>Quantitiy</th>
                                            <th>Rate</th>
                                            <th>GST%</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sells as $sell)
                                            @foreach($sell->sell_products as $sell_product)
                                            @if(!isset($sell_product->product))
                                                {{dd($sell_product)}}
                                            @endif
                                                <tr>
                                                    {{-- <td><a href="{{route('sell.individual_sell',['id'=>$sell->sell_id]) }}">{{ $sell->sell_id }}</td> --}}
                                                    <td>{{ \Carbon\Carbon::parse($sell->sell_date)->format('d-m-Y') }}
                                                    </td>
                                                    <td>{{ $sell_product->product->product_name }}</td>
                                                    @if(!empty($sell_product->unit && $sell_product->unit->unit_name))
                                                        <td>{{ $sell_product->quantity }} ({{ $sell_product->unit->unit_name }})
                                                    @else    
                                                        <td>{{ $sell_product->quantity }}
                                                    @endif    
                                                        
                                                    </td>
                                                    <td>{{ $sell_product->rate }}</td>
                                                    <td>{{ $sell_product->gst }}</td>
                                                    <td>{{ $sell_product->amount }}</td>
                                                    <td>
                                                        <a href="{{route('sell.edit',['id'=>$sell->sell_id])}}"><button class="btn  btn-sm btn-info"><i class="fa fa-edit" aria-hidden="true"></i></button></a>
                                                        <a href="{{route('sell.destroy',['id'=>$sell->sell_id])}}"><button class="btn  btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
                                                    </td>
                                                 </tr>
                                            @endforeach
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Sell Date</th>
                                            <th>Product name</th>
                                            <th>Quantitiy</th>
                                            <th>Rate</th>
                                            <th>GST%</th>
                                            <th>Amount</th>
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
        <hr>

        {{-- Payment Detail --}}
        {{-- {{dd(empty($descriptions) )}} --}}
        @if(count($descriptions) > 0) 
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-success font-weight-bolder">Discount Description</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            
                            <div class="card bg-light">
                                <div class="card-body">
                                  <table class="table table-bordered">
                                    <tr>
                                       <thead>
                                           <th>Date</th>
                                           <th>Amount</th>
                                           <th>Description</th>
                                       </thead>
                                       <tbody>
                                           @foreach ($descriptions as $description)
                                           <tr>
                                                <td>{{ \Carbon\Carbon::parse($description->pay_date)->format('d-m-Y') }}</td>
                                                <td>{{$description->pay_received}}</td>
                                                <td>{{$description->description}}</td>
                                            </tr>  
                                           @endforeach
                                       </tbody>
                                    </tr>
                                  </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        @endif


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

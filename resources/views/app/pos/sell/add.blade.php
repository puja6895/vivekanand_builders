@extends('layouts.home')

@section('title','Sell | Add')

@section('Sell')
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
            <h3>Sell</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item "><a href="{{route('sell')}}">Sales</a></li>
              <li class="breadcrumb-item active">Add</li>
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
              <div class="card-header card-border">
                <button type="button" class="btn  btn-info" style="margin-bottom:10px !important;" data-toggle="modal" data-target="#myModal">
                  Last Sells
                </button>
              <a href="{{route('sell')}}"><button class="btn btn-info pull-right">Back</button></a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            
              <div class="card-body">
                {{-- Last Sell Modal --}}
                <br>
                <div class="modal fade" id="myModal">
                  <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
          
                          <!-- Modal Header -->
                          <div class="modal-header">
                              <h5 class="modal-title">Last Sells</h5>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
          
                          <!-- Modal body -->
                          {{-- <form action="add.php" method="post" enctype="multipart/form-data"> --}}
                            <div class=row>
                              <div class="table-responsive">
                                  <table class="table table-borderless col-md-12" >
                                    <thead>
                                      <tr>
                                        {{-- <th>Customer Name</th>
                                        <th>Sell Date</th>
                                        <th>Amount</th>
                                        <th>Action</th> --}}
                                        <th>Customer Name</th>
                                        <th>Sell Date</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Rate</th>
                                        <th>GST%</th>
                                        <th>Amount</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      {{-- @foreach($sells as $sell) --}}
                                      @foreach($sells->sell_products as $sell_product)
                                      <tr>
                                        <td><a href="{{route('sell.individual',['id'=>$sells->customer_id])}}">{{$sells->customer->customer_name}}</a></td>
                                        <td>{{ \Carbon\Carbon::parse($sells->sell_date)->format('d-m-Y') }}
                                        </td>
                                        <td>{{ $sell_product->product->product_name }}</td>
                                        <td>{{ $sell_product->quantity }}({{ $sell_product->unit_name }})
                                        </td>
                                        <td>{{ $sell_product->rate }}</td>
                                        <td>{{ $sell_product->gst }}</td>
                                        <td>{{ $sell_product->amount }}</td>
                                        {{-- <td>{{$sell->customer->customer_name}}</td>
                                        <td>{{\Carbon\Carbon::parse($sell->sell_date)->format('d-m-Y')}}</td>
                                        <td>{{$sell->total_amount}}</td>
                                        <td><a href="{{route('sell.individual_sell',['id'=>$sell->sell_id])}}"><button class="btn btn-sm btn-info">View</button></a></td> --}}
                                      </tr>
                                      @endforeach
                                    </tbody>
                                  </table>
                              </div>
                            </div>
          
                              <!-- Modal footer -->
                              {{-- <div class="modal-footer form-signin">
                                  <input type="submit" class="btn btn-success" value="Create" name="submit">
                              </div> --}}
                          {{-- </form> --}}
          
                      </div>
                  </div>
              </div>
                <form  method="POST" action="{{route('sell.store')}}" >
                  @csrf
                
                <div class="row">
                  {{-- Sell To Name --}}
                  <div class="col-md-6">
                    <div class="form-group {{ $errors->has('customer_id') ? ' has-error' : '' }}">
                      <label>Customer <span style="color: red;">*</span></label>
                      {{-- <div class="input-group"> --}}
                        {{-- <div class="input-group-prepend">
                          <label class="input-group-text" for="customer_id">
                              <i class="fa fa-user"></i>
                          </label>
                        </div> --}}
                        <select required class="form-control select2" id="customer_id" name="customer_id">
                          <option selected="" disabled="">Select Customer</option>
                          @foreach($customers as $customer)
                          <option value="{{$customer->customer_id}}">{{$customer->customer_name}}</option>
                          @endforeach
                        </select>
                      {{-- </div> --}}
                    </div>
                  </div>

                  <!--Purchase DATE  -->
                  <div class="col-md-6">
                    <div class="form-group {{ $errors->has('sell_date') ? ' has-error' : '' }}">
                      <label>Sell Date <span style="color: red;">*</span></label>
                      <div class="input-group">
                        {{-- <div class="input-group-prepend">
                          <label class="input-group-text" for="datepicker">
                            <i class="fa fa-calendar"></i>
                          </label>
                        </div> --}}
                        <input type="text" name="sell_date" class="form-control datepicker list_date " id="datepicker" required="" placeholder="dd-mm-yyyy">
                        @if ($errors->has('sell_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('sell_date') }}</strong>
                        </span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>

                <hr>
                <div class="alert alert-error alert-dismissible" role="alert" style="display: none" id="js_error_panel">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <strong>Error!</strong> <span id="js_error"></span>
                </div>

                <div class="row">
                  <div class=" table-responsive">

                    <div class="row">
                      <div class="col-md-6">
                        <h6> ADD Products/Material</h6>
                      </div>
                      <div class="col-md-6 pull-right">

                      </div>
                    </div>

                    {{-- <div class="row border table p-3" id="thead">
                        <div class="col-md-4">Product</div>
                        <div class="col-md-2">Quantity</div>
                        <div class="col-md-2">Rate</div>
                    </div>
                    <div class="row border table p-3" id="tbody">
                      <div class="col-md-4">Product</div>
                      <div class="col-md-2">Quantity</div>
                      <div class="col-md-2">Rate</div>
                    </div> --}}

                    <table class="table table-bordered col-md-12" id="">
                      <thead>
                        <tr>
                          <th class="" style="width:20%">Product</th>
                          <th class="" style="width:10%">Unit</th>
                          <th class="">Quantity</th>
                          <th class="" style="width:15%">Rate</th>
                          <th class="">GST</th>
                          <th class="" style="width:15%">Total</th>
                          <th class="">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="" style="width:20%">
                            <select required name="product_id0" id="product_id0" class="form-control select2" onchange="setDefault()">
                              <option value="0"> Product </option>
                              @foreach($products as $product)
                                <option value="{{$product->product_id}}">{{$product->product_name}}</option>
                              @endforeach
                            </select>
                          </td>
                          <td class="" style="width:10%">
                            <select required name="unit_id0" id="unit_id0" class="form-control select2" >
                              <option value="0"> Unit </option>
                              @foreach($units as $unit)
                                <option value="{{$unit->unit_id}}">{{$unit->unit_name}}</option>
                              @endforeach
                            </select>
                          </td>
                          <td class="">
                            <input class="form-control" type="number" name="quantity0" id="quantity0" value="1" required onchange="calculateTotal()">

                          </td>
                          <td class="" style="width:15%">
                            <div class="input-group">
                               <span class="input-group-prepend">
                                 <label for="rate0" class="input-group-text">
                                  <span style="font-size: 17px;">&#8377;</span>
                                 </label>
                               </span>
                               <input type="text" class="form-control" name="rate0" id="rate0" onchange="calculateTotal()" required value="0">
                             </div>
                         </td>
                          <td class="">
                            <div class="input-group">
                              <input type="text" class="form-control" name="gst0" id="gst0" onchange="calculateTotal()" required value="0">
                              <span class="input-group-append">
                                <label for="" class="input-group-text">
                                  <i class="fa fa-percent" aria-hidden="true"></i>
                                </label>
                              </span>
                            </div>
                          </td>
                          <td class="" style="width:15%">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                  <label for="total0" class="input-group-text">
                                    <span style="font-size: 17px;">&#8377;</span>
                                  </label>
                                </span>
                                <input type="text" class="form-control" name="total0" id="total0" readonly value="0">
                              </div>
                          </td>
                          
                          <td>
                            <button type="button" data-toggle="tooltip" title="Add Product" class="btn btn-success pull-right" id="addrow"> 
                                <i class="fa fa-plus"></i>
                              
                            </button>
                        </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <hr>

                <div class="row">
                  <div class=" table-responsive">
                    <table class="table table-bordered col-md-12" id="purchaseTable">
                      <tr>
                        <th class="" style="width:20%">Product</th>
                          <th class="" style="width:10%">Unit</th>
                          <th class="">Quantity</th>
                          <th class="" style="width:15%">Rate</th>
                          <th class="">GST</th>
                          <th class="" style="width:15%">Total</th>
                          <th class="">Action</th>
                      </tr>
                    </table>
                  </div>
                </div>

              </div>

              <!-- <hr>
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-bordered">
                    <tr>
                      <td colspan="6" align="right">SubTotal</td>
                      <td><b>
                        <i class="fa fa-inr"></i><span id="subTotal"> 0 </span>
                      </b></td>
                    </tr>
                    <tr>
                      <td colspan="6" align="right">GST</td>
                      <td><b>
                        <i class="fa fa-inr"></i><span id="totalGst">0</span>
                      </b>
                    </td>
                    </tr>
                    <tr>
                      <td colspan="6" align="right">Grand Total</td>
                      <td><b>
                        <i class="fa fa-inr"></i><span id="grandTotal">0</span>
                      </b>
                    </td>
                    </tr>
                  </table>
                </div>
              </div> -->
              <!-- /.box-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Save</button>
                <a href=""><button type="button" class="btn btn-primary"> <i class="fa fa-times"></i> Cancel</button></a>
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
<script type="text/javascript" src="{{asset('js/sell.js')}}"></script>  
<script>
  defaultDate()
</script> 
@endsection           
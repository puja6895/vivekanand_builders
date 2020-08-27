@extends('layouts.home')

@section('title','Sell | Edit')

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
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item "><a href="{{ route('sell') }}">Sales</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
                    @foreach($errors->all() as $error)
                        @if($error)
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Error!</strong> {{ $error }}
                            </div>
                        @endif
                    @endforeach


                    <div class="card card-muted">
                        <div class="card-header card-border">
                            <h3 class="card-title text-secondary">Edit Sell </h3>
                            <a href="{{ route('sell') }}"><button
                                    class="btn btn-info pull-right">Back</button></a>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('sell.update') }}">
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    {{-- Sell To Name --}}
                                    <div class="col-md-6">
                                        <div
                                            class="form-group {{ $errors->has('customer_id') ? ' has-error' : '' }}">
                                            <label>Customer <span style="color: red;">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text" for="customer_id">
                                                        <i class="fa fa-user"></i>
                                                    </label>
                                                </div>
                                                {{-- <select required class="form-control" id="customer_id"
                                                    name="customer_id">
                                                    <option selected="" disabled="">Select Customer</option>
                                                    @foreach($customers as $customer)
                                                        <option value="{{ $customer->customer_id }}">
                                                            {{ $customer->customer_name }}</option>
                                                    @endforeach
                                                </select> --}}
                                                <input readonly type="text" name="customer_name" required class="form-control  {{$errors->has('customer_name') ? 'is-invalid' : ''}}" id="customer_name" placeholder="Enter unit" value="{{ $sells->customer->customer_name}}">

                                                {{-- @if ($errors->has('customer_id'))
                          <span class="help-block">
                              <strong>{{ $errors->first('customer_id') }}</strong>
                                                </span>
                                                @endif--}}
                                            </div>
                                        </div>
                                    </div>

                                    <!--Purchase DATE  -->
                                    <div class="col-md-6">
                                        <div
                                            class="form-group {{ $errors->has('sell_date') ? ' has-error' : '' }}">
                                            <label>Sell Date <span style="color: red;">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text" for="datepicker">
                                                        <i class="fa fa-calendar"></i>
                                                    </label>
                                                </div>
                                                {{-- <input type="text" name="sell_date"
                                                    class="form-control datepicker list_date" id="datepicker"
                                                    required="" value="{{\Carbon\Carbon::parse($sells->sell_date)->format('d-m-Y') }}" >
                                                @if($errors->has('sell_date'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('sell_date') }}</strong>
                                                    </span>
                                                @endif --}}
                                                <input readonly  type="text" name="sell_date" required class="form-control  {{$errors->has('sell_date') ? 'is-invalid' : ''}}" id="sell_date" placeholder="Enter unit" value="{{\Carbon\Carbon::parse($sells->sell_date)->format('d-m-Y') }}">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="alert alert-error alert-dismissible" role="alert" style="display: none"
                                    id="js_error_panel">
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
                                                        <input class="form-control" type="number" name="quantity0"
                                                            id="quantity0" value="1" required
                                                            onchange="calculateTotal()">

                                                    </td>
                                                    <td class="" style="width:15%">
                                                        <div class="input-group">
                                                            <span class="input-group-prepend">
                                                                <label for="rate0" class="input-group-text">
                                                                    <span style="font-size: 17px;">&#8377;</span>
                                                                </label>
                                                            </span>
                                                            <input type="text" class="form-control" name="rate0"
                                                                id="rate0" onchange="calculateTotal()" required
                                                                value="0">
                                                        </div>
                                                    </td>
                                                    <td class="">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="gst0"
                                                                id="gst0" onchange="calculateTotal()" required
                                                                value="0">
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
                                                            <input type="text" class="form-control" name="total0"
                                                                id="total0" readonly value="0">
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <button type="button" data-toggle="tooltip" title="Add Product"
                                                            class="btn btn-success pull-right" id="addrow">
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
                                                <input type="hidden" name="sell_id" value="{{$sells->sell_id }}">                                                
                                                    @foreach($sells->sell_products as $sell_product)
                                                    
                                                    <tr>
                                                        <input type="hidden" name="sell_product_id[]" value="{{$sell_product->sell_products_id }}">

                                                        <input readonly class="form-control" type="hidden" name="unit_id[]" placeholder="Unit" required value="{{$sell_product->unit_id}}">
                                                           {{-- {{ dd($sells->sell_products->product)}} --}}
                                                           <input type="hidden" name="product_id[]" value="{{$sell_product->product->product_id}}">
                                                            <td style="width:15rem"><input class="form-control" value="{{$sell_product->product->product_name}}"
                                                                
                                                                    type="text" name="product_name[]" readonly required=""
                                                                    placeholder="Product"></td>

                                                            <td style="width:8rem"><input readonly class="form-control"
                                                                    type="text" name="unit_name[]" placeholder="Unit" required
                                                                    value="{{$sell_product->unit_name}}">  </td>

                                                            <td><input class="form-control" type="number" name="quantity[]"
                                                                    value="{{$sell_product->quantity}}" required></td>

                                                            <td>
                                                                <div class="input-group"><span
                                                                        class="input-group-prepend">
                                                                        <label class="input-group-text">
                                                                            <span style="font-size: 17px;">&#8377;</span>
                                                                        </label></span><input
                                                                        type="text" class="form-control" name="rate[]"
                                                                        required value="{{$sell_product->rate}}"></div>

                                                            <td>
                                                                <div class="input-group"><input type="text"
                                                                        class="form-control" name="gst[]" required
                                                                        value="{{$sell_product->gst}}"><span
                                                                        class="input-group-prepend"><label
                                                                            class="input-group-text"><i
                                                                                class="fa fa-percent"></i></label></span>
                                                                </div>
                                                            </td>

                                                            <td style="width:10rem">
                                                                <div class="input-group"><span
                                                                        class="input-group-prepend"><label
                                                                            class="input-group-text">
                                                                            <span style="font-size: 17px;">&#8377;</span>
                                                                        </label></span><input
                                                                        type="text" class="form-control" name="total[]" readonly
                                                                        required value="{{$sell_product->amount}}"></div>
                                                            </td>

                                                            <td>
                                                                <button type="button" class="btn btn-sm btn-danger ibtnDel" onclick="deleteRow(this)" 
                                                                    data-toggle="tooltip" title="Delete Product">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </td>

                                                        </tr>
                                                    
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>


                            <!-- /.box-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Save</button>
                                <a href=""><button type="button" class="btn btn-primary"> <i class="fa fa-times"></i>
                                        Cancel</button></a>
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
<script type="text/javascript" src="{{ asset('js/sell.js') }}"></script>
@endsection

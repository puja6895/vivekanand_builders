@extends('layouts.home')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3> Invoice</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
                        {{-- <li class="breadcrumb-item"><a href="#">Layout</a></li> --}}
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="container">
                                <div class="row pl-5 pt-4 pb-2 pr-3">
                                    <div class="col-md-6">
                                        <h3 class="text-bold">Ajit Singh</h3>
                                    </div>

                                    <div class="col-md-6 text-right">
                                    <p class="font-weight-bold text-muted mb-1">Bill No:{{$bill_no}} </p>
                                        <p class="font-weight-bold text-muted mb-1">Bill Date: {{$date}}</p>
                                    </div>
                                </div>

                                <hr class="my-2">

                                <div class="row pb-3 p-4 ">
                                    <div class="col-md-6">
                                        <p class="font-weight-bold text-muted mb-3">Client Information</p>
                                        <p class="mb-1 text-bold">{{ $sells[0]->customer->customer_name }}</p>
                                        {{-- <p class="text-bold">{{ $sells[0]->customer->customer_mobile }}</p> --}}
                                        <p class="mb-1 text-bold">{{ $sells[0]->customer->customer_address }}
                                        </p>
                                    </div>
                                </div>

                                <hr class="my-2">

                                <div class="row text-center">
                                    <div class="col-2 text-uppercase small font-weight-bold">Date</div>
                                    <div class="col-2 text-uppercase small font-weight-bold">Item</div>
                                    <div class="col-2 text-uppercase small font-weight-bold">Unit</div>
                                    <div class="col-2 text-uppercase small font-weight-bold">Quantity</div>
                                    <div class="col-2 text-uppercase small font-weight-bold">Rate</div>
                                    <div class="col-2 text-uppercase small font-weight-bold">Amount</div>
                                </div>

                                <hr class="my-2">

                                <div class="row text-center">
                                    @foreach($sells as $sell)
                                        @foreach($sell->sell_products as $sell_product)
                                            {{-- <tr> --}}
                                            <div class="col-2 text-uppercase small ">
                                                {{ \Carbon\Carbon::parse($sell->sell_date)->format('d-m-Y') }}
                                            </div>
                                            <div class="col-2 text-uppercase small ">
                                                {{ $sell_product->product->product_name }}</div>
                                            <div class="col-2 text-uppercase small ">{{ $sell_product->unit_name }}
                                            </div>
                                            <div class="col-2 text-uppercase small ">{{ $sell_product->quantity }}
                                            </div>
                                            <div class="col-2 text-uppercase small ">{{ $sell_product->rate }}</div>
                                            <div class="col-2 text-uppercase small ">{{ $sell_product->amount }}</div>
                                            {{-- </tr> --}}
                                        @endforeach
                                    @endforeach
                                    <br>
                                    <div class="col-2 text-uppercase small "></div>
                                    <div class="col-2 text-uppercase small "></div>
                                    <div class="col-2 text-uppercase small "></div>
                                    <div class="col-2 text-uppercase small "></div>
                                    <div class="col-2 text-uppercase  font-weight-bold">Sub-Total</div>
                                    <div class="col-2 text-uppercase  font-weight-bold">{{$sub_total}}</div>
                                </div>

                                <hr class="my-2">

                                <p class="ml-3 pt-2 text-bold text-muted">Previous Bill:</p>
                                <div class="row text-center">
                                    <div
                                        class="col-1 pt-2 pb-2 border-top border-bottom text-uppercase small font-weight-bold">
                                        Bill No</div>
                                    <div
                                        class="col-1 pt-2 pb-2 border-top border-bottom text-uppercase small font-weight-bold">
                                        From</div>
                                    <div
                                        class="col-1 pt-2 pb-2 border-top border-bottom text-uppercase small font-weight-bold">
                                        To</div>
                                    <div
                                        class="col-1 pt-2 pb-2 border-top border-bottom text-uppercase small font-weight-bold">
                                        Due Amount</div>
                                    <div class="col-8 text-uppercase small font-weight-bold"></div>
                                </div>

                                <div class="row text-center">
                                    <div class="col-1 border-bottom pb-1 pt-1 text-uppercase small">
                                        {{ $previous_bill->bill_no ?? "NIL" }}</div>
                                    <div class="col-1 border-bottom pb-1 pt-1 text-uppercase small">
										@if(!empty($previous_bill))
											{{ \Carbon\Carbon::parse($previous_bill->from_date)->format('d-m-Y') ?? "NIL" }}</div>
										@else
											{{ $previous_bill->from_date ?? "NIL" }}</div>
										@endif
                                    <div class="col-1 border-bottom pb-1 pt-1 text-uppercase small">
                                        @if(!empty($previous_bill))
											{{ \Carbon\Carbon::parse($previous_bill->to_date)->format('d-m-Y') ?? "NIL" }}</div>
										@else
											{{ $previous_bill->from_date ?? "NIL" }}</div>
										@endif
                                    <div class="col-1 border-bottom pb-1 pt-1 text-uppercase small">
                                        {{ $previous_bill->due_amount ?? "NIL" }}</div>
                                    <div class="col-8 text-uppercase small font-weight-bold"></div>
                                </div>

                                <br class="my-1">

                                <p class="ml-3 text-bold text-muted">Payment Details:</p>
                                <div class="row text-center">
                                    <div
                                        class="col-1 pt-2 pb-2 border-top border-bottom text-uppercase small font-weight-bold">
                                        Date</div>
                                    <div
                                        class="col-1 pt-2 pb-2 border-top border-bottom text-uppercase small font-weight-bold">
                                        mode</div>
                                    <div
                                        class="col-1 pt-2 pb-2 border-top border-bottom text-uppercase small font-weight-bold">
                                        payment</div>
                                    <div class="col-9 text-uppercase small font-weight-bold"></div>
                                </div>

                                <div class="row text-center">
									@if(!empty($payments))
										@foreach($payments as $payment)
											<div class="col-1 pb-1 pt-1 text-uppercase small">{{ \Carbon\Carbon::parse($payment->pay_date)->format('d-m-Y') }}
											</div>
											<div class="col-1 pb-1 pt-1 text-uppercase small">{{ $payment->pay_mode }}
											</div>
											<div class="col-1 pb-1 pt-1 text-uppercase small">{{ $payment->pay_received }}
											</div>
											<div class="col-9 text-uppercase small font-weight-bold"></div>
										@endforeach
									@else
										<div class="col-1 pb-1 pt-1 text-uppercase small"> NIL
										</div>
										<div class="col-1 pb-1 pt-1 text-uppercase small"> NIL
										</div>
										<div class="col-1 pb-1 pt-1 text-uppercase small"> NIL
										</div>
										<div class="col-9 text-uppercase small font-weight-bold"></div>
									@endif
                                    {{-- <div class="col-1 border-bottom"></div>
									<div class="col-1 border-bottom"></div>
									<div class="col-1 border-bottom"></div> --}}
                                    <div class="col-9 "></div>
                                </div>

                                <hr class="my-2">

                                <div class="row text-center">
                                    <div class="col-2 text-uppercase small font-weight-bold"></div>
                                    <div class="col-2 text-uppercase small font-weight-bold"></div>
                                    <div class="col-2 text-uppercase small font-weight-bold"></div>
                                    <div class="col-2 text-uppercase small font-weight-bold"></div>
                                    <div class="col-2 text-uppercase  font-weight-bold">Due Amount</div>
                                    <div class="col-2 text-uppercase  font-weight-bold">{{$due_amount}}</div>
                                </div>

                                <br class="my-1">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection


<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>A simple, clean, and responsive HTML invoice template</title>
    
    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr >
                <td colspan="5">
                    <table>
                        <tr>
                            <td class="title" style=" text-align:center">
                               <h2>Ajit Singh</h2>
                            </td>
                           
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td >
                    <table>
                        <tr>
                            <td style="text-align: left">
                                <b>Client Information:</b><br>
                                {{ $sells[0]->customer->customer_name }}<br>
                                {{ $sells[0]->customer->customer_address }}<br><br>
                                <b>Bill Date: </b>{{$date}}<br>
                                <b>Bill No: </b>{{$bill_no}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
              
                
                <td>
                    Date
                </td>
                <td>Item</td>
                <td>Unit</td>
                <td>Quantity</td>
                <td>Rate</td>
                <td>Amount</td>

            </tr>
            @foreach($sells as $sell)
            @foreach($sell->sell_products as $sell_product)
                
            <tr class="item">
                <td>
                    {{ \Carbon\Carbon::parse($sell->sell_date)->format('d-m-Y') }}
                </td>
                <td>
                {{ $sell_product->product->product_name }}</td>
                <td>{{ $sell_product->unit_name }}
                </td>
                <td>{{ $sell_product->quantity }}
                </td>
                <td>{{ $sell_product->rate }}</td>
                <td>{{ $sell_product->amount }}</td>
            </tr>
            @endforeach
            @endforeach

            <tr class="item">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><b>Sub-Total:</b></td>
                <td><b>{{$sub_total}}</b></td>
            </tr>
           
            <tr class="heading">
                <td >
                  Bill No
                </td>
                
                <td>
                   From
                </td>
                <td>
                    To
                 </td>
                 <td>
                   Previous Amount
                 </td>
            </tr>
            
            <tr class="detail">
                <td>
                    {{ $previous_bill->bill_no ?? "NIL" }}
                </td>
                
                <td>
                    @if(!empty($previous_bill))
                    {{ \Carbon\Carbon::parse($previous_bill->from_date)->format('d-m-Y') ?? "NIL" }}</div>
                @else
                    {{ $previous_bill->from_date ?? "NIL" }}</div>
                @endif
                </td>
                <td>
                    @if(!empty($previous_bill))
											{{ \Carbon\Carbon::parse($previous_bill->to_date)->format('d-m-Y') ?? "NIL" }}</div>
										@else
											{{ $previous_bill->from_date ?? "NIL" }}</div>
										@endif
                </td>
                <td>
                    {{ $previous_bill->due_amount ?? "NIL" }}
                </td>
            </tr>
            
            {{-- <tr class="item">
                <td>
                    Hosting (3 months)
                </td>
                
                <td>
                    $75.00
                </td>
            </tr>
            <tr></tr><br>
            <tr class="item last">
                <td>
                    Domain name (1 year)
                </td>
                
                <td>
                    $10.00
                </td>
            </tr>
            
            <tr class="total">
                <td></td>
                
                <td>
                   Total: $385.00
                </td>
            </tr> --}}
            <tr class="heading">
                <td >
                 Date
                </td>
                
                <td>
                  Mode  
                </td>
                <td>
                   Payment
                 </td>
                
            </tr><br><br>
           
            <tr class="detail">
                @foreach($payments as $payment)
                <td>
                    {{ \Carbon\Carbon::parse($payment->pay_date)->format('d-m-Y') }}
                </td>
                
                <td>
                    {{ $payment->pay_mode }}
                </td>
                <td>
                    {{ $payment->pay_received }}
                </td>
                @endforeach
            </tr>
        </table>
    </div>
</body>
</html>

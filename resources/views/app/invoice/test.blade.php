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
            {{-- <tr><h4>Payment Details:</h4></tr> --}}
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
            </tr>
        </table>
    </div>
</body>
</html>
 
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    
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
    
    /* @media only screen and (max-width: 600px) {
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
    } */
    
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
            <tr class="">
                <td colspan="6">
                    <table>
                        <tr>
                            <td class="title">
                                {{-- <img src="https://www.sparksuite.com/images/logo.png" style="width:100%; max-width:300px;"> --}}
                                <p style="font-size:35px;  "><b>Ajit Singh</b></p>
                            </td>
                            
                            <td style="margin-top: 20px !important; ">
                                <b>Bill #:</b> {{$bill_no}}<br>
                                <b>Bill Date: </b> {{$date}}<br>
                               
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information" >
                <td >
                    <table>
                        <tr>
                            <td>
                                <b>Client Information:</b><br>
                                {{ $sells[0]->customer->customer_name }}<br>
                                {{ $sells[0]->customer->customer_address }}
                            </td>
                            
                            <td>
                                {{-- Acme Corp.<br>
                                John Doe<br>
                                john@example.com --}}
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
                <td></td>
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
                <td>
                </td>
                <td>{{ $sell_product->quantity }} ({{ $sell_product->unit_name }})
                </td>
                <td>{{ $sell_product->rate }}</td>
                <td>{{ $sell_product->amount }}</td>
            </tr>
            @endforeach
            @endforeach
            
           
            
            
            
            <tr class="item last">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="color:#176334;"><b>Sub-Total:</b></td>
                <td style="color:#176334;"><b><span>&#8377;</span> {{$sub_total}}</b></td>
            </tr>
            <tr >
                <td><b>Previous Bill Detail:</b></td>
            </tr>
            <tr class="heading">
                <td >
                  Bill No
                </td>
                
                <td>
                   From
                </td>
                <td></td>
                <td>
                    To
                 </td>
                 <td></td>
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
                <td></td>
                <td>
                    @if(!empty($previous_bill))
											{{ \Carbon\Carbon::parse($previous_bill->to_date)->format('d-m-Y') ?? "NIL" }}</div>
										@else
											{{ $previous_bill->from_date ?? "NIL" }}</div>
										@endif
                </td>
                <td></td>
                <td>
                    {{ $previous_bill->due_amount ?? "NIL" }}
                </td>
            </tr>
            <tr ><br>
                <td><b>Payment Detail:</b></td>
            </tr>
            <tr class="heading">
                <td >
                 Date
                </td>
                
                <td>
                  Mode  
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                   Payment
                 </td>
                
            </tr><br><br>
           
            <tr class="detail">
                @if(count($payments)>0)
                @foreach($payments as $payment)
                <td>
                    {{ \Carbon\Carbon::parse($payment->pay_date)->format('d-m-Y') }}
                </td>
                
                <td>
                {{ $payment->pay_mode }}
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    {{ $payment->pay_received }}
                </td>
                @endforeach
                @else
                <td>NIL</td>
                <td>NIL</td>
                <td></td>
                <td></td>
                <td></td>
                <td>NIL</td>
                @endif
            </tr>
            <tr class="item last">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="color:#a3140a;"><b>Due-Amount:</b></td>
                <td style="color:#a3140a;"><b><span>&#8377;</span> {{$due_amount}}</b></td>
            </tr>
        </table>
    </div>
</body>
</html>


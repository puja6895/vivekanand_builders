<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $bill_no }}</title>
    {{-- <link rel="stylesheet" href="style.css" media="all" /> --}}
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            /* border-bottom: 1px solid black; */
            position: relative;
            width: 21cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        #logo {
            text-align: center;
            margin-bottom: 10px;
        }

        #logo img {
            width: 90px;
        }

        h1 {
            border-top: 1px solid #5D6975;
            border-bottom: 1px solid #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
        }

        #project {
            float: left;
        }

        #project span {
            color: rgb(1, 6, 12);
            font-weight: bold;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
        }

        #company {
            float: right;
            text-align: right;
            margin-right: 10px;
        }

        #project div,
        #company div {
            white-space: nowrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table .service,
        table .desc {
            /* text-align: left; */
        }

        table td {
            padding: 10px;
            /* text-align: right; */
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table td.grand {
            border-top: 1px solid #5D6975;
            ;
        }

        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }

    </style>
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            {{-- <img src="logo.png"> --}}
        </div>
        <h1>{{ $current_bill->admin->admin_name }}</h1>
        <div id="company" class="clearfix">
            <div><b>Bill # : </b> {{ $bill_no }}</div>
            <div><b>Bill Date :</b> {{ $date }}</div>
            {{-- <div>(602) 519-0450</div>
        <div><a href="mailto:company@example.com">company@example.com</a></div>  --}}
        </div>
        <div id="project">
            {{-- <div><span>PROJECT</span> Website development</div> --}}
            <div><span>CLIENT</span> <span>{{ $sells->first()->customer->customer_name }}</span> </div>
            <div><span>ADDRESS</span> {{ $sells->first()->customer->customer_address }} </div>
            {{-- <div><span>EMAIL</span> <a href="mailto:john@example.com">john@example.com</a></div>
        <div><span>DATE</span> August 17, 2015</div>
        <div><span>DUE DATE</span> September 17, 2015</div> --}}
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class="service">DATE</th>
                    <th>ITEM</th>
                    <th>QUANTITY</th>
                    <th>RATE</th>
                    <th>AMOUNT</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sells as $sell)
                {{-- {{dd($sells)}} --}}
                    @foreach($sell->sell_products as $sell_product)
                        <tr>
                            <td>
                                {{ \Carbon\Carbon::parse($sell->sell_date)->format('d-m-Y') }}
                            </td>
                            <td>{{ $sell_product->product->product_name }}</td>

                            <td>{{ $sell_product->quantity }} ({{ $sell_product->unit->unit_name }})
                            </td>
                            <td>{{ $sell_product->rate }}</td>

                            <td>{{ $sell_product->amount }}</td>
                        </tr>
                    @endforeach
                @endforeach
                <tr>
                    <td style="background: white !important;"></td>
                    <td style="background: white !important;"></td>
                    <td style="background: white  !important;"></td>
                    <td style="color:#176334;background: white  !important;"><b>SUB-TOTAL</b></td>
                    <td class="total" style="color:#176334;background: white  !important;">
                        <b><span>&#8377;</span>{{ $sub_total }}</b></td>
                </tr>
            </tbody>
        </table>
        @if(!empty($previous_bill))
        {{-- {{dd($previous_bill->due_amount )}} --}}
        @if($previous_bill->due_amount != 0)
            <hr>
            <p style=" padding: 10px; font-size: 0.9em; ">
                <b>PREVIOUS BILL DETAILS : </b>
            </p>
            <table>
                <thead>
                    <tr>
                        <th class="service">BILL NO</th>
                        <th class=>FROM</th>
                        <th>TO</th>
                        <th>PREVIOUS DUE AMOUNT</th>
                        {{-- <th>TOTAL</th> --}}
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            {{ $previous_bill->bill_no }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($previous_bill->from_date)->format('d-m-Y') ?? "NIL" }}
                            </div>
                        </td>
                        <td>

                            {{ \Carbon\Carbon::parse($previous_bill->to_date)->format('d-m-Y') ?? "NIL" }}
                            </div>
                        </td>
                        <td>
                            {{ $previous_due_amount }}
                        </td>
                        {{-- <td class="total">$1,040.00</td> --}}
                    </tr>
                </tbody>
            </table>
        @endif
        @endif
        @if(count($payments)>0)
            <hr>
            <p style=" padding: 10px; font-size: 0.9em; ">
                <b>PAYMENTS: </b>
            </p>
            <table>
                <thead>
                    <tr style="text-align: left !important;">
                        <th class="service">DATE</th>
                        <th>MODE</th>
                        <th>PAY AMOUNT</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                        <tr>

                            <td>
                                {{ \Carbon\Carbon::parse($payment->pay_date)->format('d-m-Y') }}
                            </td>
                            <td>
                                {{ $payment->pay_mode }}
                            </td>
                            <td>
                                {{ $payment->pay_received }}
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                    <tr>
                        <td style="background: white  !important;"></td>
                        <td style="background: white  !important;"></td>
                        <td style="background: white  !important;"></td>
                        <td style="color:#176334; text-align: left !important; background: white  !important;">
                            <b>TOTAL</b></td>
                        <td class="total"
                            style="color:#176334; text-align: left !important; background: white  !important;">
                            <b><span>&#8377;</span>{{ $sum_payments }}</b></td>
                        {{-- <td></td> --}}
                    </tr>
            </table>
        @endif
        <table class="responsive">
            <tr>
                <td style="background: white !important;"></td>
                <td style="background: white !important;"></td>
                <td style="background: white !important;"></td>
                <td style="background: white !important;"></td>
                <td style="background: white !important;"></td>
                <td style="background: white !important;"></td>
                <td style="background: white !important;"></td>
                <td style="color:#a3140a; text-align:right; background: white !important;"><b>DUE-AMOUNT</b></td>
                <td class="total" style="color:#a3140a; background: white !important;">
                    <b><span>&#8377;</span>{{ $due_amount }}</td>
            </tr>
            </tbody>
        </table>

        {{-- <div id="notices">
            <div>NOTICE:</div>
            <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
        </div> --}}
    </main>
    {{-- <footer>
        Invoice was created on a computer and is valid without the signature and seal.
    </footer> --}}
</body>
<tr>

</tr>

</html>

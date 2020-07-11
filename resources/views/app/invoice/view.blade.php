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
                                        <h4 class="text-bold">Vivekanand Traders</h4>
                                    </div>

                                    <div class="col-md-6 text-right">
                                    <p class="font-weight-bold text-muted mb-1">Bill No: </p>
                                        <p class="font-weight-bold text-muted mb-1">Bill Date: </p>
                                    </div>
                                </div>

                                <hr class="my-2">

                                <div class="row pb-3 p-4 ">
                                    <div class="col-md-6">
                                        <p class="font-weight-bold text-muted mb-3">Client Information</p>
                                        <p class="mb-1 text-bold"></p>
                                        <p class="text-bold"></p>
                                        <p class="mb-1 text-bold">
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
                                    {{-- @foreach($sells as $sell) --}}
                                        {{-- @foreach($sell->sell_products as $sell_product) --}}
                                            {{-- <tr> --}}
                                            {{-- <div class="col-2 text-uppercase small ">
                                                {{ \Carbon\Carbon::parse($sell->sell_date)->format('d-m-Y') }}
                                            </div>
                                            <div class="col-2 text-uppercase small ">
                                                {{ $sell_product->product->product_name }}</div>
                                            <div class="col-2 text-uppercase small ">{{ $sell_product->unit_name }}
                                            </div>
                                            <div class="col-2 text-uppercase small ">{{ $sell_product->quantity }}
                                            </div>
                                            <div class="col-2 text-uppercase small ">{{ $sell_product->rate }}</div>
                                            <div class="col-2 text-uppercase small ">{{ $sell_product->amount }}</div> --}}
                                            {{-- </tr> --}}
                                        {{-- @endforeach --}}
                                    {{-- @endforeach --}}
                                    <br>
                                    <div class="col-2 text-uppercase small "></div>
                                    <div class="col-2 text-uppercase small "></div>
                                    <div class="col-2 text-uppercase small "></div>
                                    <div class="col-2 text-uppercase small "></div>
                                    <div class="col-2 text-uppercase  font-weight-bold">Sub-Total</div>
                                    <div class="col-2 text-uppercase  font-weight-bold"></div>
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
                                    {{-- <div class="col-1 border-bottom pb-1 pt-1 text-uppercase small">
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
                                    <div class="col-8 text-uppercase small font-weight-bold"></div> --}}
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
											<div class="col-1 pb-1 pt-1 text-uppercase small">
											</div>
											<div class="col-1 pb-1 pt-1 text-uppercase small">
											</div>
											<div class="col-1 pb-1 pt-1 text-uppercase small">
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
                                    <div class="col-2 text-uppercase  font-weight-bold"></div>
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

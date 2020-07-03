@extends('layouts.home')
@section('content')
<div class="content-wrapper">
		<section class="content">
			<div class="content-fluid">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-body p-0">
								<div class="row p-5">
									<div class="col-md-6">
										<span class="text-bold">Vivekanand Traders</span>
									</div>
			
									<div class="col-md-6 text-right">
										<p class="font-weight-bold text-muted mb-1">Bill No: </p>
										<p class="font-weight-bold text-muted mb-1">Bill Date: </p>
									</div>
								</div>
			
								<hr class="my-2">
								{{-- {{dd($sells)}} --}}
								<div class="row pb-5 p-4">
									<div class="col-md-6">
										<p class="font-weight-bold text-muted mb-4">Client Information</p>
										<p class="mb-1">{{$sells[0]->customer->customer_name}}</p>
										<p>{{$sells[0]->customer->customer_mobile}}</p>
										<p class="mb-1">{{$sells[0]->customer->customer_address}}</p>
										{{-- <p class="mb-1">6781 45P</p> --}}
									</div>
			
								</div>
								<div class="card">
									<div class="card-header text-bold text-muted">Product Summary</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-12">
												<table class="table">
													<thead>
														<tr>
															<th class="border-0 text-uppercase small font-weight-bold">DATE</th>
															<th class="border-0 text-uppercase small font-weight-bold">Item</th>
															<th class="border-0 text-uppercase small font-weight-bold">Quantity</th>
															<th class="border-0 text-uppercase small font-weight-bold">Unit </th>
															<th class="border-0 text-uppercase small font-weight-bold">Rate</th>
															<th class="border-0 text-uppercase small font-weight-bold">Amount</th>
														</tr>
													</thead>
													<tbody>
														@foreach($sells as $sell)
														@foreach($sell->sell_products as $sell_product)
														<tr>
															<td>{{\Carbon\Carbon::parse($sell->sell_date)->format('d-m-Y')}}</td>
															<td>{{$sell_product->product->product_name}}</td>
															<td>{{$sell_product->quantity}}</td>
															<td>{{$sell_product->unit_name}}</td>
															<td>{{$sell_product->rate}}</td>
															<td >{{$sell_product->amount}}</td>
														</tr>
														@endforeach
														@endforeach
														<tr>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															<td class=" font-weight-bold">Sub-Total Amount:</td>
															<td class="text-bold">{{$sub_total}}</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								
								{{-- <hr class="my-3"> --}}
								<div class="row  ">
									<div class="col-md-5">
										<p class="ml-4 text-bold text-muted">Previous Bill:</p>
										<table class="table">
											<thead>
												<tr>
													<th class="border-0 text-uppercase small font-weight-bold"> Bill No</th>
													<th class="border-0 text-uppercase small font-weight-bold">From Date</th>
													<th class="border-0 text-uppercase small font-weight-bold">To Date</th>
													<th class="border-0 text-uppercase small font-weight-bold">Amount</th>
												</tr>
											</thead>
											<tbody>
												
												<tr>
													<td>{{$previous_bill->bill_no}}</td>
													<td>{{$previous_bill->from_date}}</td>
													<td>{{$previous_bill->to_date}}</td>
													<td>{{$previous_bill->amount}}</td>
												</tr>
												
											</tbody>
										</table>
									</div>
								</div>
								<div class="row">
									<div class="col-md-5">
										<p class="ml-4 text-bold text-muted">Payment Details:</p>
										<table class="table">
											<thead>
												<tr>
													<th class="border-0 text-uppercase small font-weight-bold"> Date</th>
													<th class="border-0 text-uppercase small font-weight-bold">Mode</th>
													<th class="border-0 text-uppercase small font-weight-bold">Amount</th>
												</tr>
											</thead>
											<tbody>

												@foreach($payments as $payment)
												<tr>
													<td>{{$payment->pay_date}}</td>
													<td>{{$payment->pay_mode}}</td>
													<td>{{$payment->pay_received}}</td>
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
								<div class="row mb-4" style="margin-left:58%;">
									<div class="col-md-5">
										<table>
											<th>
												<tr>
													<td class=" font-weight-bold">Due Amount:</td>
													<td style="margin-left:20px  !important">{{$due_amount}}</td>
												</tr>
											</th>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
@endsection






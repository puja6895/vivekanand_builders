<?php

namespace App\Http\Controllers;

use App\GstPayment;
use App\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use View;
use DB;

class GstPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $gstayments = GstPayment::all();
        return view::make('app.gst.gst_payment.list')->with(['gstayments'=>$gstayments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $customers = Customer ::where('isDeleted',0)->get();
        return view::make('app.gst.gst_payment.add')->with(['customers'=>$customers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'customer_id' => 'required|exists:customers,customer_id',
            'pay_date' => 'required',
            'pay_received' => 'required'
        ]);

        try{
            DB::beginTransaction();

            $gstpayment = new GSTPayment;
            $gstpayment->customer_id=$request->customer_id;
            $gstpayment->pay_date = Carbon::parse($request->pay_date)->format('Y-m-d');
            $gstpayment->pay_received=$request->pay_received;
            $gstpayment->pay_mode=$request->pay_mode;
            $gstpayment->save();

        DB::commit();
        return redirect()->route('gstpayments')->with('success','Gst Payment Added');


        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();

        }      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GstPayment  $gstPayment
     * @return \Illuminate\Http\Response
     */
    public function show(GstPayment $gstPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GstPayment  $gstPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(GstPayment $gstPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GstPayment  $gstPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GstPayment $gstPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GstPayment  $gstPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(GstPayment $gstPayment)
    {
        //
    }
}

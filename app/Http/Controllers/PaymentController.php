<?php

namespace App\Http\Controllers;
use App\Payment;
use App\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use View;

class PaymentController extends Controller
{
    //
    public function index()
    {
        
        $payments=Payment::all();
        return view :: make('app.payment.list')->with('payments',$payments); 
        

    }
    public function create(){
        
        $customers = Customer::all();
        return view :: make('app.payment.add')->with('customers',$customers);
    }

    public function store(Request $request){
        
        $this->validate($request, [
            'customer_id' => 'required|exists:customers,customer_id',
			'pay_date' => 'required',
        ]);
        try{
            DB::beginTransaction();

                $payment = new Payment;
                $payment->customer_id=$request->customer_id;
                $payment->pay_date = Carbon::parse($request->pay_date)->format('Y-m-d');
                $payment->pay_received=$request->pay_received;
                $payment->pay_mode=$request->pay_mode;
                $payment->save();

            DB::commit();
                return redirect()->route('payment.add')->with('success','Payment Added');

            }catch(Exception $exception){
                DB::rollBack();
                return back()->with('error',$exception->getMessage())->withInput();
    
            }   

    }
}

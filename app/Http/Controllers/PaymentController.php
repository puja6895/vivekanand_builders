<?php

namespace App\Http\Controllers;
use App\Payment;
use App\Customer;
use Carbon\Carbon;
use App\BillDetail;
use Illuminate\Http\Request;
use DB;
use View;

 function test(){

    $bill_details = Billdetail::all();
    $customers = Customer::where('isDeleted',0)->get();

    return(['customers'=>$customers ,'bill_details'=>$bill_details ]);

}

function paymnet_bill(){

    $bill_details = Billdetail::all();
    $customers = Customer::where('isDeleted',0)->get();

    return(['customers'=>$customers ,'bill_details'=>$bill_details ]);

}

class PaymentController extends Controller
{
    //
    public function index()
    {
        
        $payments=Payment::all();
        return view :: make('app.payment.list')->with('payments',$payments); 
        

    }

    public function create(){
        
        $test  = test();
        return view :: make('app.payment.add')->with(['customers'=>$test['customers'] ,'bill_details'=>$test['bill_details']]);
    }

    public function individual($customer_id){

        $select_customer = Customer :: find($customer_id);
        $test  = test();
        return view :: make('app.payment.add')->with(['customers'=>$test['customers'] ,'bill_details'=>$test['bill_details'] ,'select_customer'=>$select_customer]);

    }

    public function bill_payment($bill_id){

        $bills = BillDetail :: find($bill_id);
        // dd($bills->due_amount);
        $bill_payment = paymnet_bill();

        return view :: make('app.payment.add')->with(['customers'=>$bill_payment['customers'] ,'bill_details'=>$bill_payment['bill_details'] ,'bills'=>$bills]);

    }

    public function store(Request $request){
        // dd($request);
        $this->validate($request, [
            'customer_id' => 'required|exists:customers',
            'pay_date' => 'required',
            'pay_received' => 'required'

        ]);
        // dd($request->customer_id);
        try{
            DB::beginTransaction();


                $discount_amount = $request->discount_amount;
                $description = $request->description;
                 $r_pay_recevied = $request->pay_received;
                // dd($r_pay_recevied);
                $r_bill_id = $request->bill_id;
            if($r_pay_recevied > 0)
            {
                $payment = new Payment;
                // dd($r_bill_id == '-1');
                
                if( $r_bill_id == '-1'){

                    $payment->status = 0;
                    
                }else{
                    $payment->status = 1;

                    $due_amount = BillDetail::where('bill_id',$r_bill_id)->first();
                    // $due_amount = $due_amounts->first();

                    // dd(empty($due_amount));
                    // dd( $due_amount[0]->due_amount - $pay_recevied);  
                    if(!empty($due_amount)){

                     $discount = $discount_amount !=null ? $discount_amount : 0;   
                        
                    $bill_due = BillDetail::where(['bill_id'=>$request->bill_id])
                                            ->update(['due_amount'=> $due_amount->due_amount -  $r_pay_recevied - $discount]);

                    }
                    // else{
                        
                    //     $due_amount->due_amount = 0;
                        
                    //     $bill_due = BillDetail::where(['bill_id'=>$request->bill_id])
                    //     ->update(['due_amount'=> $due_amount->due_amount -  $r_pay_recevied ]); 
                    // }                        // dd($bill_due);   
                }
                    $payment->customer_id=$request->customer_id;
                    $payment->pay_date = Carbon::parse($request->pay_date)->format('Y-m-d');
                    $payment->pay_received=$r_pay_recevied;
                    $payment->pay_mode=$request->pay_mode;
                    $payment->save();
            }    
                  
                    
                    // dd( $discount_amount);
                    
                    if($discount_amount  != null){
                        
                        $payment = new Payment;
                        $payment->status = 2;
                        $payment->customer_id=$request->customer_id;
                        $payment->pay_date = Carbon::parse($request->pay_date)->format('Y-m-d');
                        $payment->pay_received=$discount_amount;
                        $payment->pay_mode=$request->pay_mode;
                        $payment->description=$description;
                        // dd($payment->pay_received);
                        $payment->save();

                        
                        
                    }
            DB::commit();
                return redirect()->route('payment.add')->with('success','Payment Added');

        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();

        }  
    // }     

    }

    public function destroy($id)
    {
        //
        try{
            //DB Transaction Begin
            DB:: beginTransaction();
            $payment=Payment::where('pay_amount_id',$id);

            if($payment){
                $payment->delete();
                // $default_Product->save();

                DB::commit();
                return redirect()->route('payments')->with('success','Payment Deleted');
            }else{
                return back()->with('error','Invalid Payment');
            }    

        }catch(Exception $exception){
                DB::rollBack();
                return back()->with('error',$exception->getMessage())->withInput();
            }
    }
}

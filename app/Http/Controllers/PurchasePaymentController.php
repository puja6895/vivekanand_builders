<?php

namespace App\Http\Controllers;
use App\PurchasePayment;
use App\Purchaser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use View;
use DB;


class PurchasePaymentController extends Controller
{
    //
    public function index(){

        $payments = PurchasePayment::all();
        return view::make('app.purchase_payment.list')->with(['payments'=>$payments]);
    }
    public function create(){
        $purchasers = Purchaser::all();
        return view :: make('app.purchase_payment.add')->with(['purchasers'=>$purchasers ]);
    }

    public function store(Request $request){
       
        $this->validate($request, [
            'purchaser_id' => 'required|exists:purchasers,purchaser_id',
            'paid_date' => 'required',
            'paid' => 'required'
        ]);
        try{
            DB::beginTransaction();
                
                $debit = $request->debit;
                $credit = $request->credit;
                $paid_amount   = $request->paid;

                if($debit == ""){
                    $debit = 0;
                }

                if($credit == ""){
                    $credit = 0;
                }

                $paid = $paid_amount + $debit;
                // $paid = $paid_amount + ($paid_amount*($debit/100));;
                

                
                $paid = $paid - $credit;
                // $paid = $paid -  ($paid*($credit/100));
                
                // dd($paid);
                
                $purchase_payment = new PurchasePayment;
                $purchase_payment->purchaser_id=$request->purchaser_id;
                $purchase_payment->paid_date = Carbon::parse($request->paid_date)->format('Y-m-d');
                $purchase_payment->paid_mode=$request->paid_mode;
                $purchase_payment->debit=$debit;
                $purchase_payment->credit=$credit;
                $purchase_payment->paid=$request->paid;
                $purchase_payment->final_paid= $paid;
                $purchase_payment->save();


        DB::commit();
                return redirect()->route('purchase_payments')->with('success','Payment Added');

            }catch(Exception $exception){
                DB::rollBack();
                return back()->with('error',$exception->getMessage())->withInput();
    
            }  

    }
}

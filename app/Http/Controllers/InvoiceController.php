<?php

namespace App\Http\Controllers;
use App\Customer;
use App\Sell;
use App\Payment;
use App\BillDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use View;

class InvoiceController extends Controller
{
    //
    public function add(){
        $customers = Customer::all();
        return view:: make('app.invoice.add')->with(['customers'=>$customers]);
    }

    public function invoice(Request $request){

        $this->validate($request, [
            'customer_id' => 'required|exists:customers,customer_id',
			'from_date' => 'required',
			'to_date' => 'required',
        ]);
        try{
            $customer_id = $request->customer_id;
            $from_date =  Carbon::parse($request->from_date)->format('Y-m-d');
            $to_date =  Carbon::parse($request->to_date)->format('Y-m-d');

            DB::beginTransaction();

            $exists_bill = BillDetail::where('customer_id',$customer_id)
                                      ->where('from_date',$from_date)
                                      ->where('to_date',$to_date)
                                      ->get();
            

            // if(count($exists_bill)<=0){

                $record = BillDetail::latest()->first();
                $invoice_number = explode('-',$record->bill_no);
                // dd($invoice_number);
                $current_timestamp = Carbon::now()->format('m-Y');
                //  dd($current_timestamp); 
                
               

                $previous_bill = BillDetail::where('customer_id',$customer_id)
                                            ->whereDate('to_date' , '<' , $from_date)
                                            ->orderBy('to_date','desc');

                $sell_query = Sell ::where('customer_id',$customer_id)
                                       ->whereBetween('sell_date',array($from_date,$to_date))
                                       ->orderBy('sell_date','desc');

                $payment_query = Payment::where('customer_id',$customer_id)
                                       ->whereBetween('pay_date',array($from_date , $to_date)) 
                                       ->orderBy('pay_date','desc');

                $sells = $sell_query->get();
                $payments = $payment_query->get();

                $sell_amount = $sell_query->sum('total_amount');
                $payment_amount = $payment_query->sum('pay_received');

                // dd($previous_bill);
                if($previous_bill->count()<=0){
                    
                    $previous_due_amount = 0;

                }else{
                    $previous_due_amount = $previous_bill->first()->amount; 
                }

                $due_amount =   $sell_amount  + $previous_due_amount -  $payment_amount; 
                // dd($due_amount);  
                
                

                $current_bill = new BillDetail;   
                $current_bill->customer_id = $request->customer_id;
                if($current_timestamp==date("m-Y")){
                    $nextinvioce_number = "VNB".'-01'. '-'.date("m-Y");     

                    $current_bill->bill_no = $nextinvioce_number;
                    // dd( $nextinvioce_number);               
                }else{
                    $nextinvioce_number = $invoice_number[0]. '-' .$invoice_number[1]+1 . '-' .$invoice_number[2];
                    
                    $current_bill->bill_no = $nextinvioce_number;
                // dd( $nextinvioce_number); 
                }
                
                $current_bill->from_date =  Carbon::parse($request->from_date)->format('Y-m-d');
                $current_bill->to_date =   Carbon::parse($request->to_date)->format('Y-m-d');
                $current_bill->amount = $due_amount;
                $current_bill ->save(); 
            

                // $sub_total = DB::table('sells')
                //                 ->join('sell_products', 'sell_products.sell_id', '=', 'sells.sell_id')
                //                 ->where('sells.customer_id',$request->customer_id)
                //                 ->whereBetween('sell_date',array($from_date,$to_date))
                //                 ->sum('sell_products.amount');

                // $sub_total = $sell_query->sum('total_amount');
                       
                
                DB::commit();
                // dd($previous_bill->first());
                return view :: make('app.invoice.invoice')->with(['sells'=>$sells,'sub_total'=>$sell_amount,'payments'=>$payments ,'previous_bill'=>$previous_bill->first(),'due_amount'=>$due_amount]);
            // }else{
            //     return back()->with('error','Sell Already Exits');
            // }    


        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();

        }   
        
        
    }

}

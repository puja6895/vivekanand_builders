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

                     

                $current_amount = DB::table('sells')
                                  ->whereBetween('sell_date',array($from_date,$to_date))
                                  ->where('customer_id',$customer_id)
                                  ->sum('total_amount');

                $current_payment = DB::table('sell_payAmounts')  
                                       ->where('customer_id',$customer_id) 
                                       ->whereBetween('pay_date',array($from_date,$to_date))
                                       ->sum('pay_received'); 
                // dd($current_payment);  
                $previous_bill = BillDetail::where('customer_id',$customer_id)
                                            ->whereDate('to_date' , '<' , $from_date)
                                            ->orderBy('to_date','desc');
                                          
                                            
                // dd($previous_bill);
                if($previous_bill->count()<=0){
                    
                
                $previous_due_amount = 0;
                // dd( $previous_due_amount);$current_payment; 
                // dd($due_amount);           
                
                

                }else{

                    $previous_due_amount = $previous_bill->first()->amount; 
                }

                $due_amount =   $current_amount  + $previous_due_amount -  $current_payment; 
                // dd($due_amount);           

                $current_bill = new BillDetail;   
                $current_bill->customer_id = $request->customer_id;
                $current_bill->bill_no = 0;
                $current_bill->from_date =  Carbon::parse($request->from_date)->format('Y-m-d');
                $current_bill->to_date =   Carbon::parse($request->to_date)->format('Y-m-d');
                $current_bill->amount = $due_amount;
                $current_bill ->save(); 
            

                $sells = Sell ::where('customer_id',$customer_id)
                                ->whereBetween('sell_date',array($from_date,$to_date))
                                ->get();


                $payments = Payment::where('customer_id',$customer_id)
                                    ->whereBetween('pay_date',array($from_date , $to_date)) 
                                    ->get(); 
            
            
                $sub_total = DB::table('sells')
                                ->join('sell_products', 'sell_products.sell_id', '=', 'sells.sell_id')
                                ->where('sells.customer_id',$request->customer_id)
                                ->whereBetween('sell_date',array($from_date,$to_date))
                                ->sum('sell_products.amount');

                                // dd($sub_total);
                       
                
                DB::commit();
                // dd($previous_bill->first());
                return view :: make('app.invoice.invoice')->with(['sells'=>$sells,'sub_total'=>$sub_total,'payments'=>$payments ,'previous_bill'=>$previous_bill->first(),'due_amount'=>$due_amount]);
            // }else{
            //     return back()->with('error','Sell Already Exits');
            // }    


        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();

        }   
        
        
    }

}

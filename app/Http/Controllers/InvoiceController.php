<?php

namespace App\Http\Controllers;
use App\Customer;
use App\Sell;
use App\Payment;
use App\BillDetail;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use DB;
use View;

class InvoiceController extends Controller
{
    public function index(){
        $bill_details = BillDetail::all();
        return view :: make('app.invoice.invoiceList')->with(['bill_details'=>$bill_details]);
    }

    //
    public function add(){
        $customers = Customer::all();
        return view:: make('app.invoice.add')->with(['customers'=>$customers]);
    }


    public function store(Request $request){

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
            

            if(count($exists_bill)<=0){

               
               

                // $previous_bill = BillDetail::where('customer_id',$customer_id)
                //                             ->whereDate('to_date' , '<' , $from_date)
                //                             ->orderBy('to_date','desc');

                $sell_query = Sell ::where('customer_id',$customer_id)
                                       ->whereBetween('sell_date',array($from_date,$to_date))
                                       ->orderBy('sell_date','asc');

                $payment_query = Payment::where('customer_id',$customer_id)
                                       ->whereBetween('pay_date',array($from_date , $to_date)) 
                                       ->where('status', 0)
                                       ->orderBy('pay_date','desc');

                $sells = $sell_query->get();
                $payments = $payment_query->get();

                $sell_amount = $sell_query->sum('total_amount');
                $payment_amount = $payment_query->sum('pay_received');

                $previous_bill_detail = BillDetail::whereDate('from_date' ,'<',$from_date)
                                                    ->whereDate('to_date', '<',$to_date)
                                                    ->orderBy('from_date','desc');


                $previous_bill = $previous_bill_detail->first();
                                            
                $previous_bill_no = BillDetail::latest()->first();

                if(!empty($previous_bill_no)){
                    $invoice_number = explode('-',$previous_bill_no->bill_no);
                }
                
                if(!empty($previous_bill)){
                    $previous_due_amount = $previous_bill->due_amount; 

                }
                else{
                    $previous_due_amount = 0;
                }
                
                // dd($previous_bill);
                // if($previous_bill->count()<=0){
                    
                //     $previous_due_amount = 0;
                    
                // }else{
                //     $previous_due_amount = $previous_bill->first()->amount; 
                // }
                
                $due_amount =   $sell_amount  + $previous_due_amount -  $payment_amount; 
                
                
                $current_timestamp = Carbon::now()->format('m-Y');
                $current_date = Carbon::now()->format('d-m-Y');
                
                // dd($current_timestamp!=date("m-Y"));  
                if($current_timestamp!=date("m-Y") || empty($previous_bill_no)){
                    $nextinvioce_number = "VNB".'-1'. '-'.date("m-y");
                }else{
                    $nextinvioce_number = $invoice_number[0].'-'.($invoice_number[1]+1).'-'.$invoice_number[2].'-'.$invoice_number[3];
                }
                // dd( $nextinvioce_number);               

                $current_bill = new BillDetail;   
                $current_bill->customer_id = $request->customer_id;
                $current_bill->bill_date = Carbon::parse($current_date)->format('Y-m-d');
                $current_bill->bill_no = $nextinvioce_number;
                $current_bill->from_date =  Carbon::parse($request->from_date)->format('Y-m-d');
                $current_bill->to_date =   Carbon::parse($request->to_date)->format('Y-m-d');
                $current_bill->amount = $due_amount;
                $current_bill->due_amount = $due_amount;
                $current_bill ->save(); 
          
                $bill_status = Sell::where('customer_id',$customer_id)
                                    ->whereBetween('sell_date',array($from_date , $to_date))
                                    ->update(['status' => 1]);
                // dd($bill_status);                    
                                      
                
                // DB::commit();

                // $pdf = PDF::loadView('app.invoice.test',['sells'=>$sells,'sub_total'=>$sell_amount,'payments'=>$payments ,'previous_bill'=>$previous_bill,'due_amount'=>$due_amount,'bill_no'=>$nextinvioce_number,'date'=>$current_date]);
                // return $pdf->stream();
                // dd($previous_bill->first());
                return view :: make('app.invoice.test')->with(['sells'=>$sells,'sub_total'=>$sell_amount,'payments'=>$payments ,'previous_bill'=>$previous_bill,'due_amount'=>$due_amount,'bill_no'=>$nextinvioce_number,'date'=>$current_date]);
            }else{
                return back()->with('error','Sell Already Exits');
            }    


        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();

        }   
        
        
    }

    public function view($bill_id) {

        $bills = BillDetail :: find($bill_id);

        $from_date = Carbon::parse($bills->from_date)->format('Y-m-d');
        $to_date = Carbon::parse($bills->to_date)->format('Y-m-d');
        // dd($bill);

            $sell_query = Sell ::where('customer_id',$bills->customer_id)
            ->whereBetween('sell_date',array($from_date,$to_date))
            ->orderBy('sell_date','desc');

            $payment_query = Payment::where('customer_id',$bills->customer_id)
                    ->whereBetween('pay_date',array($from_date , $to_date)) 
                    ->where('status', 0)
                    ->orderBy('pay_date','desc');

            $sells = $sell_query->get();
            $payments = $payment_query->get();

            $sell_amount = $sell_query->sum('total_amount');
            $payment_amount = $payment_query->sum('pay_received');

            // $privious_bill_detail = BillDetail::whereDate('bill_date' ,'<',$bills->bill_date)
            //                                    ->orderBy('bill_date','desc');

            $previous_bill_detail = BillDetail::whereDate('from_date' ,'<',$bills->from_date)
                                                ->whereDate('to_date', '<',$bills->to_date)
                                                ->orderBy('from_date','desc');


            $previous_bill = $previous_bill_detail->first();
            
            // dd($previous_bill);

            if(!empty($previous_bill)){
                // $invoice_number = explode('-',$previous_bill->bill_no);
                $previous_due_amount = $previous_bill->due_amount; 
              
            }else{
                $previous_due_amount = 0;
            }
            // dd($previous_due_amount);

            $due_amount =   $sell_amount  + $previous_due_amount -  $payment_amount;



            return view :: make('app.invoice.invoice')->with(['bills'=>$bills,'sells'=>$sells,'payments'=>$payments,'sub_total'=>$sell_amount,'previous_bill'=> $previous_bill,'due_amount'=>$due_amount,'date'=>$bills->bill_date,'bill_no'=>$bills->bill_no]);    


    }

    

}

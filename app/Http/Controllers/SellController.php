<?php

namespace App\Http\Controllers;
use App\Sell;
use App\Customer;
use App\Product;
use App\Unit;
use App\Sell_Product;
use App\Payment;
use App\PreviousDue;
use App\Inventory;
use App\GstSell;
use App\GstSellProduct;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use View;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $sells = Sell::orderBy('sell_date', 'desc')->get();
        return view :: make('app.pos.sell.list')->with('sells',$sells); 

       
        

    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $customers=Customer::where('isDeleted' ,0)->get();
        // $customers = Customer::where('customer_status', 1)->orderBy('customer_name')->get();

        $products = Product::all();
        // dd($products);

        $units = Unit::all();
        
        $sells = Sell::latest()->first();
        // dd($sells);

		return View::make('app.pos.sell.add')->with(['customers' => $customers, 'products' => $products, 'units' => $units,'sells'=>$sells]);
	
        // return view::make('app.pos.sell.add')->with(['customers'=>$customers]);
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
			'sell_date' => 'required',
			'product_id' => 'required|array|min:1',
			// 'unit_id' => 'required|array|min:1',
			'rate' => 'required|array|min:1',
			'quantity' => 'required|array|min:1',
			'gst' => 'required|array|min:1',
			'total' => 'required|array|min:1',
           
        ]);
    
       
            try {
                $product_id = $request->product_id;
                $unit_id = $request->unit_id;
                $rate = $request->rate;
                $quantity = $request->quantity;
                $gst = $request->gst;
                $product_name = $request->product_name;
                // $unit_name = $request->unit_name;
            //DB Transection
             DB::beginTransaction();
                // print_r($request);
                $sell = new Sell;
                $sell->customer_id = $request->customer_id;
                $sell->sell_date = Carbon::parse($request->sell_date)->format('Y-m-d');
                $sell->save();
                $sell_id = $sell->sell_id;
                // echo $sell_id;

                // $request_sell_date_year = Carbon::parse($request->sell_date)->format('Y');
                // $request_sell_date_month = Carbon::parse($request->sell_date)->format('m');
                // $request_sell_date_day = Carbon::parse($request->sell_date)->subDay()->format('d');

                // dd($request_sell_date_month);
                
                // $total_amount=0;
                $gst_amount=0;
                $total_amount=0;
                for ($i = 0; $i < count($product_id); $i++){
                    $amount = $rate[$i] * $quantity[$i];
                    $gst_amount=$amount*($gst[$i]/100);
                    $amount+=$gst_amount;

                    $sell_product= new Sell_Product;
                    $sell_product->sell_id=$sell_id;
                    $sell_product->product_id=$product_id[$i];
                    $sell_product->unit_id=$unit_id[$i];
                    // dd($unit_name[$i] ,$sell_product->unit);
                    $sell_product->unit_name=$sell_product->unit->unit_name; 
                    $sell_product->productUnitId=$sell_product->product_id.$sell_product->unit->unit_id;
                    $sell_product->rate=$rate[$i];
                    $sell_product->quantity=$quantity[$i];
                    $sell_product->gst=$gst[$i];
                    $sell_product->amount=$amount;
                    $sell_product->save();
                    
                    $total_amount+=$amount;

                    //Inventory Update
                    // $inventory = Inventory ::where(['date'=>$sell->sell_date,'product_id'=>$product_id[$i], 'unit_name'=>$unit_name[$i]])->get();
                    // dd($inventory[0]->closing_stock);

                    // if(count($inventory)<=0){

                    //     $inv = new Inventory;
                    //     $inv->date = $sell->sell_date;
                    //     $inv->product_id = $product_id[$i];
                    //     $inv->sell_stock = $quantity[$i];
                    //     $inv->unit_name = $unit_name[$i];
                    //     $inv->purchase_stock = 0;
                    
                       
                    //     $last_close = Inventory :: where('product_id',$request->product_id[$i])
                    //                               ->where('unit_name' ,$request->unit_name[$i])
                    //                               ->orderBy('date' ,'desc');
                    //                             //   ->first();

                    //     dd($last_close[0]->closing_stock);                          

                    //     if($last_close->count() <= 0){
                    //         $opening_stock    = 0;
                    //     }else{
                    //         $opening_stock = $last_close->first()->closing_stock;
                    //     }

                    //     dd($opening_stock);
                        
                    //     $inv->opening_stock  = $opening_stock;
                    //     $inv->closing_stock =  $opening_stock - $quantity[$i];
                        
                    //     $inv->save();

                    // }else{

                    //     $inv = Inventory::where((['date'=>$sell->sell_date,'product_id'=>$product_id[$i], 'unit_name'=>$unit_name[$i]]))
                    //     ->update(['sell_stock' =>  $inventory[0]->sell_stock + $quantity[$i] ,'closing_stock'=> $inventory[0]->closing_stock - $quantity[$i]]);

                    // }
                    


                }  
                $sell->total_amount=$total_amount;
                $sell->save(); 
                // Opening Stock 
                
                
            DB::commit();
            return redirect()->route('sell.add')->with('success','Sell Added');
            
        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();

        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function show(Sell $sell)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function edit(Sell $sell,$id)
    {
        //
        $sells = Sell::find($id);
        
       
        if($sells){
            // $sells = Sell::where('sell_id',$id)->get();
            //  dd($sell);

            // $customers = Customer::where('isDeleted',0)->get();
            $products = Product::all();
            $units = Unit ::all();
            return view::make('app.pos.sell.edit')->with(['products'=>$products,'units'=>$units,'sells'=>$sells]);
        }else{
            return back()->with('error','Invalid Id');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sell $sell)
    {
        //
        $this->validate($request, [
            // 'customer_id' => 'required|exists:customers,customer_id',
			'sell_date' => 'required',
			'product_id' => 'required|array|min:1',
			// 'unit_id' => 'required|array|min:1',
			'rate' => 'required|array|min:1',
			'quantity' => 'required|array|min:1',
			'gst' => 'required|array|min:1',
			'total' => 'required|array|min:1',
            
        ]);
        
        
        try {
            $product_id = $request->product_id;
            $unit_name = $request->unit_name;
            $rate = $request->rate;
            $quantity = $request->quantity;
            $gst = $request->gst;
            $product_name = $request->product_name;
            $sell_product_id = $request->sell_product_id;

            // $sell_date = Carbon::parse($request->sell_date)->format('Y-m-d');

            //DB Transection
             DB::beginTransaction();
                
                $temp_sp = Sell_Product::where('sell_products_id',$sell_product_id[0])->first();
                $sell = Sell::find($temp_sp->sell_id);

                $all_old_sp = DB::table('sell_products')->where('sell_id',$sell->sell_id)->get();
                
                // dd(count($all_old_sp));
                
                
                // $total_amount=0;
                $gst_amount=0;
                $total_amount=0;
                
                for ($i = 0; $i < count($sell_product_id); $i++){
                    // dd($sell_product);
                    $old_sp = DB::table('sell_products')->where('sell_products_id',$sell_product_id[0])->first();
                    // dd($old_sp,$sell_product_id,$request);
                    $quant_diff = $old_sp->quantity - $quantity[$i];

                    $amount = $rate[$i] * $quantity[$i];
                    $gst_amount=$amount*($gst[$i]/100);
                    $amount+=$gst_amount;

                    $sell_product_update = DB::table('sell_products')
                        ->where('sell_products_id', $sell_product_id[$i])
                        ->update(
                            [
                                'rate' => $rate[$i],
                                'quantity' => $quantity[$i],
                                'gst' => $gst[$i],
                                'amount' => $amount
                                ]
                            );
                            
                    $total_amount+=$amount;

                    //Inventory Update
                    // dd($sell->sell_date,$old_sp->product_id,$old_sp->unit_name);
                    // $inventory = Inventory ::where(['date'=>$sell->sell_date,'product_id'=>$old_sp->product_id, 'unit_name'=>$old_sp->unit_name])->first();
                    // if(!empty($inventory)){

                    //     Inventory::where((['date'=>$sell->sell_date,'product_id'=>$old_sp->product_id, 'unit_name'=>$old_sp->unit_name]))
                    //     ->update(['sell_stock' =>  $inventory->sell_stock - $quant_diff ,'closing_stock'=> $inventory->closing_stock + $quant_diff]);
                    // }
                
                }

                for( $i = 0; $i < count($all_old_sp); $i++ ) {
                    $delete_flag = 1;
                    for ($j=0; $j < count($sell_product_id) ; $j++) { 
                        if($all_old_sp[$i]->sell_products_id == $sell_product_id[$j]){
                            $delete_flag = 0;
                            break;
                        }
                    }
                    if($delete_flag == 1){
                        Sell_Product::where('sell_products_id',$all_old_sp[$i]->sell_products_id)->delete();
                    }
                }
                // For the new enteries in products
                if(count($sell_product_id) - count($product_id) < 0){
                    for ($j = 0,$i=count($sell_product_id); $j < (count($sell_product_id) + count($product_id) - 2); $j++,$i++){
                        $amount = $rate[$i] * $quantity[$i];
                        $gst_amount=$amount*($gst[$i]/100);
                        $amount+=$gst_amount;

                        $sell_product= new Sell_Product;
                        $sell_product->sell_id=$temp_sp->sell_id;
                        $sell_product->product_id=$product_id[$i];
                        $sell_product->unit_name=$unit_name[$i];
                       
                        $sell_product->rate=$rate[$i];
                        $sell_product->quantity=$quantity[$i];
                        $sell_product->gst=$gst[$i];
                        $sell_product->amount=$amount;
                        $sell_product->save();
                        
                        $total_amount+=$amount;

                        //Inventory Update
                        $inventory = Inventory ::where(['date'=>$sell->sell_date,'product_id'=>$product_id[$i], 'unit_name'=>$unit_name[$i]])->get();
                        // dd($inventory[0]->closing_stock);

                        if(count($inventory)<=0){

                            $inv = new Inventory;
                            $inv->date = $sell->sell_date;
                            $inv->product_id = $product_id[$i];
                            $inv->sell_stock = $quantity[$i];
                            $inv->unit_name = $unit_name[$i];
                            $inv->purchase_stock = 0;
                        
                        
                            $last_close = Inventory :: where('product_id',$request->product_id[$i])
                                                    ->where('unit_name' ,$request->unit_name[$i])
                                                    ->orderBy('date' ,'desc');
                                                    //   ->first();

                            // dd($last_close[0]->closing_stock);                          

                            if($last_close->count() <= 0){
                                $opening_stock    = 0;
                            }else{
                                $opening_stock = $last_close->first()->closing_stock;
                            }

                            // dd($opening_stock);
                            
                            $inv->opening_stock  = $opening_stock;
                            $inv->closing_stock =  $opening_stock - $quantity[$i];
                            
                            $inv->save();

                        }else{

                            $inv = Inventory::where((['date'=>$sell->sell_date,'product_id'=>$product_id[$i], 'unit_name'=>$unit_name[$i]]))
                            ->update(['sell_stock' =>  $inventory[0]->sell_stock + $quantity[$i] ,'closing_stock'=> $inventory[0]->closing_stock - $quantity[$i]]);

                        }
                    }
                }
                
                $sell_update = Sell::where('sell_id',$temp_sp->sell_id)
                                    ->update(['total_amount' => $total_amount]);
                // $sell->total_amount=$total_amount;
                // $sell->save(); 
                
                
            DB::commit();
            return redirect()->route('sell.individual_sell',[$temp_sp->sell_id])->with('success','Sell Updated');
            
        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sell $sell, $sell_id)
    {
        //
        try{
            $sell = Sell::find($sell_id);
            if($sell){
                $sell->sell_products()->delete();
                $sell->delete();

                DB::commit();

                // Return To Listing Page
                return redirect()->route('sell')->with('success','Sell ID no '.$sell->sell_id.' Deleted');

            }else{
                return back()->with('error','Invalid Sell ID');
            }

        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();
        }
    }

    public function individual($customer_id){
        
        $customer = Customer::find($customer_id);

        $grand_total = DB::table('sells')
                          ->where('customer_id',$customer_id)
                          ->sum('total_amount');
        // dd($grand_total);
        $sells = Sell::where('customer_id',$customer_id)->orderBy('sell_date','desc')->get();  
        // dd($sells);                     

        $payment = DB::table('sell_payAmounts')
                      ->where('customer_id',$customer_id)
                      ->sum('pay_received');
        // dd($payment);

        // $balance = $grand_total - $payment ;
        // dd($balance);
        $descriptions  = Payment::where('customer_id',$customer_id)->where('status',2)->get();
        // dd($description[1]->description);
        
        $previous_due = PreviousDue :: where('customer_id',$customer_id)->sum('previous_due_amount');
        // dd( $previous_due);

        // $sell_products = DB::table('sell_products')
        //                      ->join('sells', 'sells.customer_id','=' ,'customers.customer_id') 
        //                      ->join('sells','sell_product.sell_id','=','sells.sell_id')
        //                      ->join('products' , 'sell_products.product_id','=','products.product_id')
        //                      ->select('products.product_name','unit_name','quantity','rate','amount')
        //                      ->get();  
                            //  dd($sell_products);
        $sell_products ;                    
        return view :: make('app.pos.sell.individual')->with(['customer'=>$customer,'grand_total'=>$grand_total,'payment'=>$payment,'sells'=>$sells ,'descriptions'=>$descriptions,'previous_due'=> $previous_due]);
    }

    public function individual_sell($sell_id){
        $sell = Sell::find($sell_id);
        $sell_product_amount = Sell_Product::where('sell_id',$sell_id)->sum('amount');
        // dd($sell_product_amount);
        // $sell_product = Sell_Product::all();
        return view :: make('app.pos.sell.individual_sell')->with(['sell'=>$sell,'sell_product_amount'=>$sell_product_amount]);
    }
    
    // Selected Date List
    public function selected_date(Request $request,$customer_id){
        // DB::enableQueryLog();
       
        // $date = Carbon::createFromDate($year, $month, $day, $tz);
                $from_date  = Carbon::parse($request->from_date)->format('Y-m-d');
                $from_date_month  = Carbon::parse($request->from_date)->subMonth()->format('m');
                $from_date_year  = Carbon::parse($request->from_date)->format('Y');
                $to_date = Carbon::parse($request->to_date)->format('Y-m-d');
            
                $opening1 = Sell::where('customer_id',$customer_id)
                            ->whereMonth('sell_date','<=', $from_date_month)
                            ->whereYear ('sell_date','<=', $from_date_year)
                            ->sum('total_amount');

                    //    dd($opening1) ;
                        
                // dd(DB::getQueryLog()); 

                // $opening1= DB::table('sells')->
                // select(DB::raw('sum(total_amount) as opening1'))
                // ->whereRaw('month(sell_date) < month(?) and customer_id=?',[$from_date,$customer_id])->get();

                $opening2 =  Payment::where('customer_id',$customer_id)
                            ->whereMonth('pay_date','<=', $from_date_month)
                            ->whereYear ('pay_date','<=', $from_date_year)
                            ->sum('pay_received');
                
                            // dd($opening2) ;

                // $opening_balance = abs($opening)            
                

                $total_amount = DB::table('sells')
                                ->select(DB::raw('sum(total_amount) as total_amount'))
                                ->whereRaw('year(sell_date) = year(?) and month(sell_date) = month(?) and customer_id=?',[$from_date,$from_date,$customer_id] )->get();
                // $total_amount = Sell::where('customer_id',$customer_id)->whereBetween('sell_date', [$from_date, $to_date])->sum('total_amount');
                // dd($total_amount);
                $total_payamount = DB::table('sell_payAmounts')
                                      ->select(DB::raw('sum(pay_received) as total_payamount'))
                                      ->whereRaw('year(pay_date) = year(?) and month(pay_date) = month(?) and customer_id=?',[$from_date,$from_date,$customer_id] )->get();
                // dd( $total_payamount);
        if($from_date & $to_date ){

            $sell_product = DB::table('sell_products')
                                ->join('sells', 'sell_products.sell_id', '=', 'sells.sell_id')
                                ->join('products','sell_products.product_id' ,'=', 'products.product_id')
                                ->where('customer_id',$customer_id)
                                ->whereBetween('sell_date',array($from_date,$to_date))
                                ->select('products.product_name','unit_name','quantity','rate','gst','amount','sells.sell_date')
                                ->get();
                // dd($sell_product);
            

                $customer=Customer::find($customer_id);
                return view :: make('app.pos.sell.selected_date')
                              ->with(['total_amount'=>$total_amount,'customer'=>$customer,'total_payamount'=>$total_payamount,'opening1'=>$opening1,'opening2'=>$opening2,'from_date'=>$from_date,'sell_products'=>$sell_product]);
        }else

        {
                $sell_product = DB::table('sell_products')
                                    ->join('sells', 'sell_products.sell_id', '=', 'sells.sell_id')
                                    ->join('products','sell_products.product_id' ,'=', 'products.product_id')
                                    ->where('customer_id',$customer_id)
                                    ->whereBetween('sell_date',array($from_date))
                                    ->select('products.product_name','unit_name','quantity','rate','gst','amount','sells.sell_date')
                                    ->get();
            // dd($sell_product);
        

                $customer=Customer::find($customer_id);
                return view :: make('app.pos.sell.selected_date')
                            ->with(['total_amount'=>$total_amount,'customer'=>$customer,'total_payamount'=>$total_payamount,'opening1'=>$opening1,'opening2'=>$opening2,'from_date'=>$from_date,'sell_products'=>$sell_product]);

        }
    }

    public function gstindex(){
        
        $gstsells = GstSell::all();
        return view::make('app.pos.GST sell.list')->with('gstsells',$gstsells);

    }

    public function gstcreate()
    {
        //
        $customers=Customer::all();
        // $customers = Customer::where('customer_status', 1)->orderBy('customer_name')->get();

        $products = Product::all();
        // dd($products);

		$units = Unit::all();

		return View::make('app.pos.GST sell.add')->with(['customers' => $customers, 'products' => $products, 'units' => $units]);
	
        // return view::make('app.pos.sell.add')->with(['customers'=>$customers]);
    }  
    
    public function gststore(Request $request)
    {
        $this->validate($request, [
            'customer_id' => 'required|exists:customers,customer_id',
			'sell_date' => 'required',
			'product_id' => 'required|array|min:1',
			// 'unit_id' => 'required|array|min:1',
			'rate' => 'required|array|min:1',
			'quantity' => 'required|array|min:1',
			'gst' => 'required|array|min:1',
			'total' => 'required|array|min:1',
           
        ]);
    
       
            try {
                $product_id = $request->product_id;
                $unit_name = $request->unit_name;
                $rate = $request->rate;
                $quantity = $request->quantity;
                $gst = $request->gst;
                $product_name = $request->product_name;
                // $unit_name = $request->unit_name;
            //DB Transection
             DB::beginTransaction();
                // print_r($request);
                $gstsell = new GstSell;
                $gstsell->customer_id = $request->customer_id;
                $gstsell->sell_date = Carbon::parse($request->sell_date)->format('Y-m-d');
                $gstsell->save();
                $gst_sell_id = $gstsell->id;
                // echo $sell_id;

                // $request_sell_date_year = Carbon::parse($request->sell_date)->format('Y');
                // $request_sell_date_month = Carbon::parse($request->sell_date)->format('m');
                // $request_sell_date_day = Carbon::parse($request->sell_date)->subDay()->format('d');

                // dd($request_sell_date_month);
                
                // $total_amount=0;
                $gst_amount=0;
                $total_amount=0;
                for ($i = 0; $i < count($product_id); $i++){
                    $amount = $rate[$i] * $quantity[$i];
                    $gst_amount=$amount*($gst[$i]/100);
                    $amount+=$gst_amount;

                    $sell_product= new GstSellProduct;
                    $sell_product->sell_id=$gst_sell_id;
                    $sell_product->product_id=$product_id[$i];
                    $sell_product->unit_name=$unit_name[$i];
                   
                    $sell_product->rate=$rate[$i];
                    $sell_product->quantity=$quantity[$i];
                    $sell_product->gst=$gst[$i];
                    $sell_product->amount=$amount;
                    $sell_product->save();
                    
                    $total_amount+=$amount;

                    //Inventory Update

                }  
                $gstsell->total_amount=$total_amount;
                $gstsell->save(); 
                // Opening Stock 
                
                
            DB::commit();
            return redirect()->route('sell.add')->with('success','Gst Sell Added');
            
        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();

        } 
    }

    public function gstindividual($customer_id){
        
        $customer = Customer::find($customer_id);

        $gstsells = GstSell::where('customer_id',$customer_id)->orderBy('sell_date','desc')->get();  

        return view::make('app.pos.GST sell.individual')->with(['gstsells'=>$gstsells,'customer'=>$customer]);
        // $sells = DB::table('sells')
        //             ->join('sell_products', 'sell_products.sell_id', '=' , 'sells.sell_id')
        //             ->join('products', 'sell_products.product_id' , '=' , 'products.product_id')
        //             ->where('sells.customer_id',$customer_id)
        //             ->where('gst' , '>' ,0)
        //             ->select('products.product_name','sells.sell_date','sell_products.product_id','sell_products.quantity','sell_products.unit_name','sell_products.rate','sell_products.gst','sell_products.amount')

        //             ->get();  
    }  
    
    public function test(){
        // $sell_products = Sell_Product::all();
        // foreach($sell_products as $sp){
        //     $update_sp = DB::table('sell_products')
        //       ->where('sell_products_id', $sp->sell_products_id)
        //       ->update(['unit_id' => $sp->unit->unit_id]);
        // }
        // $ip_update = DB::select(DB::raw('update invent set productUnitId = concat(product_id,unit_id)'));
        $sp_update = DB::select(DB::raw('update sell_products set productUnitId = concat(product_id,unit_id)'));
        $pp_update = DB::select(DB::raw('update purchase_products set productUnitId = concat(product_id,unit_id)'));
        DB::commit();

    }
    
}

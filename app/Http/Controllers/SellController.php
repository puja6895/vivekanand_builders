<?php

namespace App\Http\Controllers;
use App\Sell;
use App\Customer;
use App\Product;
use App\Unit;
use App\Sell_Product;
use App\Payment;
use App\Inventory;
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
        $customers=Customer::all();
        // $customers = Customer::where('customer_status', 1)->orderBy('customer_name')->get();

        $products = Product::all();
        // dd($products);

		$units = Unit::all();

		return View::make('app.pos.sell.add')->with(['customers' => $customers, 'products' => $products, 'units' => $units]);
	
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
                $unit_name = $request->unit_name;
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
    public function edit(Sell $sell)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sell $sell)
    {
        //
    }

    public function individual($customer_id){
        
        $customer = Customer::find($customer_id);

        $grand_total = DB::table('sells')
                          ->where('customer_id',$customer_id)
                          ->sum('total_amount');
        
        $sells = Sell::where('customer_id',$customer_id)->get();  
        // dd($sells[0]->sell_products);                     

        $payment = DB::table('sell_payAmounts')
                      ->where('customer_id',$customer_id)
                      ->sum('pay_received');

        // $sell_products = DB::table('sell_products')
        //                      ->join('sells', 'sells.customer_id','=' ,'customers.customer_id') 
        //                      ->join('sells','sell_product.sell_id','=','sells.sell_id')
        //                      ->join('products' , 'sell_products.product_id','=','products.product_id')
        //                      ->select('products.product_name','unit_name','quantity','rate','amount')
        //                      ->get();  
                            //  dd($sell_products);
        $sell_products ;                    
        return view :: make('app.pos.sell.individual')->with(['customer'=>$customer,'grand_total'=>$grand_total,'payment'=>$payment,'sells'=>$sells]);
    }

    public function individual_sell($sell_id){
        $sell = Sell::find($sell_id);
        // $sell_product = Sell_Product::all();
        return view :: make('app.pos.sell.individual_sell')->with('sell',$sell);
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

   
}

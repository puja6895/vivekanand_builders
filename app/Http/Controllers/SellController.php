<?php

namespace App\Http\Controllers;

use App\Sell;
use App\Customer;
use App\Product;
use App\Unit;
use App\Sell_Product;
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
        
        // $sell=Sell::join('customers','sells.customer_id', '=', 'customers.customer_id')->select('sell_id','customer_name','sell_date','payment_recived','total_amount')->get();;
        // if(isset($customer_id)){

        //     $sell = Sell::where('customer_id',$customer_id)->with(['customer'])->get();
        // }else{
        //     $sell = Sell::with(['customer'])->get(); 
        // }
        // // dd($sell);

        // return view::make('app.pos.sell.list')->with('sells',$sell);

        // $customer = Customer::find(1);
        // return view :: make('app.pos.sell.list')->with('customer',$customer);
        $sells = Sell::orderBy('sell_date', 'desc')->get();
        return view :: make('app.pos.sell.list')->with('sells',$sells);
        

    }
    // public function index(){
    //     $customer = Customer::find(1);
    //     return view :: make('app.pos.sell.list')->with('sells',$customer->sells);
    // }

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
                
                
                // $total_amount=0;
                // $gst=0;
                $total_amount=0;
                for ($i = 0; $i < count($product_id); $i++){
                    $amount = $rate[$i] * $quantity[$i];
                    // $gst=$amount*($gst*100);
                    
                    $sell_product= new Sell_Product;
                    $sell_product->sell_id=$sell_id;
                    $sell_product->product_id=$product_id[$i];
                    $sell_product->unit_name=$unit_name[$i];
                    $sell_product->rate=$rate[$i];
                    $sell_product->quantity=$quantity[$i];
                    // $sell_product->gst=$gst[$i];
                    $sell_product->amount=$amount;
                    $sell_product->save();
                    
                    $total_amount+=$amount;
                }  
                $sell->total_amount=$total_amount;
                $sell->save(); 
                // echo $sell_id;
                // dd($sell); 
            DB::commit();
            return redirect()->route('sell')->with('success','Sell Added');
            
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
        return view :: make('app.pos.sell.individual')->with('customer',$customer);
    }

    public function individual_sell($sell_id){
        $sell = Sell::find($sell_id);
        return view :: make('app.pos.sell.individual_sell')->with('sell',$sell);
    }
}

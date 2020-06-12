<?php

namespace App\Http\Controllers;

use App\Sell;
use App\Customer;
use App\Product;
use App\Unit;
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
            // 'product_name'     => 'required',
             'customer_id'   => 'required|exists:customers',
           
        ]);
    
        try {
            //DB Transection
            DB::beginTransaction();

            $sell = new Sell;
            // $product->product_name=$request->product_name;
            $sell->customer_id=$request->customer_id;
            $sell->sell_date = Carbon::parse($request->sell_date)->format('Y-m-d');
            // $sell->payment_received=$request->payment_received;
            $sell->total_amount=$request->total_amount;
            $sell->save();

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
}

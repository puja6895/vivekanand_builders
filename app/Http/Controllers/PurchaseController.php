<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\PurchaseProduct;
use App\Purchaser;
use App\Product;
use App\Inventory;
use App\Unit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use View;
use DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $purchases = Purchase::orderBy('purchase_date', 'desc')->get();
        return view :: make('app.purchase.list')->with(['purchases'=>$purchases]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $purchasers = Purchaser::all();
        $products = Product::all();
        $units = Unit::all();
        return view :: make('app.purchase.add')->with(['purchasers'=>$purchasers,'products'=>$products,'units'=>$units]);
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
            'purchaser_id' => 'required|exists:purchasers,purchaser_id',
			'purchase_date' => 'required',
			'product_id' => 'required|array|min:1',
			'unit_id' => 'required|array|min:1',
			'rate' => 'required|array|min:1',
			'quantity' => 'required|array|min:1',
			'gst' => 'required|array|min:1',
			'total' => 'required|array|min:1',
           
        ]);

        try 
        {

            $product_id = $request->product_id;
            $unit_id = $request->unit_id;
            $rate = $request->rate;
            // dd($rate);
            $quantity = $request->quantity;
            $gst = $request->gst;
            $product_name = $request->product_name;
            $unit_name = $request->unit_name;
        //DB Transection
         DB::beginTransaction();
            // print_r($request);
            $purchase = new Purchase;
            $purchase->purchaser_id = $request->purchaser_id;
            $purchase->purchase_date = Carbon::parse($request->purchase_date)->format('Y-m-d');
            $purchase->save();

            $purchase_id = $purchase->purchase_id;

            $gst_amount=0;
                $total_amount=0;
                for ($i = 0; $i < count($product_id); $i++){
                    $amount = $rate[$i] * $quantity[$i];
                    $gst_amount=$amount*($gst[$i]/100);
                    $amount+=$gst_amount;

                    $purchase_product= new PurchaseProduct;
                    $purchase_product->purchase_id=$purchase_id;
                    $purchase_product->product_id=$product_id[$i];
                    $purchase_product->unit_id=$unit_id[$i];
                    $purchase_product->productUnitId=$purchase_product->product_id.$purchase_product->unit_id;
                    // dd($purchase_product);
                    $purchase_product->rate=$rate[$i];
                    $purchase_product->quantity=$quantity[$i];
                    $purchase_product->gst=$gst[$i];
                    $purchase_product->amount=$amount;
                    $purchase_product->save();
                    
                    $total_amount+=$amount;


                    // $inventory = Inventory ::where(['date'=>$purchase->purchase_date,'product_id'=>$product_id[$i], 'unit_name'=>$unit_name[$i]])->get();
                    // if(count($inventory)<=0){

                    //     $inv = new Inventory;
                    //     $inv->date = $purchase->purchase_date;
                    //     $inv->product_id = $product_id[$i];
                    //     $inv->sell_stock = 0;
                    //     $inv->unit_name = $unit_name[$i];
                    //     $inv->purchase_stock = $quantity[$i];
                    
                       
                    //     $last_close = Inventory :: where('product_id',$request->product_id[$i])
                    //                               ->where('unit_name' ,$request->unit_name[$i])
                    //                               ->orderBy('date' ,'desc')->get();
                    //                             //   ->first();

                                                

                    //     // dd($last_close);                          

                    //     if($last_close->count() <= 0){
                    //         $opening_stock    = 0;
                    //     }else{
                    //         $opening_stock = $last_close->first()->closing_stock;
                    //     }

                    //     // dd($opening_stock);
                        
                    //     $inv->opening_stock  = $opening_stock;
                    //     $inv->closing_stock =  $opening_stock + $quantity[$i];
                        
                    //     $inv->save();

                    // }else{

                    //     $inv = Inventory::where((['date'=>$purchase->purchase_date,'product_id'=>$product_id[$i], 'unit_name'=>$unit_name[$i]]))
                    //     ->update(['purchase_stock' =>  $inventory[0]->purchase_stock + $quantity[$i] ,'closing_stock'=> $inventory[0]->closing_stock + $quantity[$i]]);

                    // }
                    
                }        
                $purchase->total_amount=$total_amount;
                $purchase->save(); 
            DB::commit();
            return redirect()->route('purchase.add')->with('success','Purchase Added');
            
        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();

        }      

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
    public function individual($purchaser_id){
        
        $purchaser = Purchaser::find($purchaser_id);

        $grand_total = DB::table('purchases')
                          ->where('purchaser_id',$purchaser_id)
                          ->sum('total_amount');
        // dd($grand_total);
        $purchases = Purchase::where('purchaser_id',$purchaser_id)->get();  
        // dd($sells[0]->sell_products);                     

        $payment = DB::table('purchase_payments')
                      ->where('purchaser_id',$purchaser_id)
                      ->sum('final_paid');

        // dd($payment);
        $balance = ($grand_total -  $payment);
        // dd($balance);
        $sell_products ;                    
        return view :: make('app.purchase.individual')->with(['purchaser'=>$purchaser,'grand_total'=>$grand_total,'purchases'=>$purchases,'payment'=>$payment]);
    }

    public function individual_sell($sell_id){
        $sell = Sell::find($sell_id);
        // $sell_product = Sell_Product::all();
        return view :: make('app.pos.sell.individual_sell')->with('sell',$sell);
    }

}

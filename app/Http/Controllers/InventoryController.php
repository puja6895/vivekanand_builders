<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Product;
use App\Unit;
use App\Sell_Product;
use App\PurchaseProduct;
use Illuminate\Http\Request;
use DB;
use View;
use Carbon\Carbon;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $inventories = Inventory::orderBy('date','desc')->get();
        return view::make('app.inventory.list')->with(['inventories'=>$inventories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $products = Product::all();
        $units = Unit::all();
        return view::make('app.inventory.add')->with(['units'=>$units,'products'=>$products]);
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
			'product_id' => 'required|exists:products,product_id',
			'unit_id' => 'required|exists:units,unit_id',
            'quantity' => 'required',
            'date'     => 'required'
        ]);

        try{

            DB::beginTransaction();

                
                    $inventory = new Inventory;
                    $inventory->date = Carbon::parse($request->date)->format('Y-m-d');
                    $inventory->product_id = $request->product_id;
                    $inventory->unit_id = $request->unit_id;
                    $inventory->quantity = $request->quantity;
                    $inventory->save();

                
                
               
                
            DB::commit();
				// Return To Listing Page
                return redirect()->route('inventories')->with('success', 'Inventory Created SuccessFully.');
               
        }catch (Exception $exception) {
			DB::rollBack();
			return back()->with('error', $exception->getMessage())->withInput();
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        //
    }

    public function turn_index(){

        $stock= DB::select(DB::raw('select product_id, unit_name,sum(quantity) as stock from invent group by product_id ,unit_name'));

        $total_sell = array();
        $total_purchase = array();
       for($i=0; $i< count($stock) ; $i++){
            $sell = Sell_Product::select(DB::raw('product_id, unit_name, sum(quantity) as sQuantity'))
                                ->where('product_id',$stock[$i]->product_id)
                                ->where('unit_name',$stock[$i]->unit_name)
                                ->groupBy('product_id','unit_name')->first();

            array_push($total_sell,$sell);
            
            $purchase = PurchaseProduct::select(DB::raw('product_id, unit_id, sum(quantity) as pQuantity'))
                                        ->where('product_id',$stock[$i]->product_id)
                                        ->where('unit_id',$stock[$i]->unit_name)
                                        ->groupBy('product_id','unit_id')->first();
            array_push($total_purchase,$purchase);
            
        }
        $merged = collect($total_sell)->zip($total_purchase,$stock)->transform(function ($values) {
            return [
                // 'test'=> $values,
                'product_id' => $values[2] == null ? "":$values[2]->product_id,
                'unit_name' => $values[2] == null ? "":$values[2]->unit_name,
                'sell_quantity' => $values[0] == null ? 0:$values[0]->sQuantity,
                'purchase_quantity' => $values[1] == null ? 0:$values[1]->pQuantity,
                'stock' => $values[2] == null ? "":$values[2]->stock,
                'closing' => (($values[2] == null ? 0:$values[2]->stock)+($values[1] == null ? 0:$values[1]->pQuantity))-($values[0] == null ? 0:$values[0]->sQuantity)
            ];
        });
        dd($merged);
        foreach($merged as $temp){
            echo($temp["product_id"]);
            echo "<br>";
        }
  

        return view::make('app.inventory.turn');
    }

    public function turn_list(Request $request){

  
  
    }
}

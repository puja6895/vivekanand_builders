<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Product;
use App\Unit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use View;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventories = Inventory::orderBy('date','desc')->get();
        return view :: make('app.inventory.list')->with(['inventories' => $inventories  ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $products = Product ::all();
        // dd($product)
        $units = Unit :: all();
        return view :: make('app.inventory.add')
                    -> with(['products'=>$products,'units'=>$units]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  DB::enableQueryLog();
        //
        $this->validate($request, [
			'product_id' => 'required|exists:products,product_id',
			// 'unit_name' => 'required|exits:units',
            'quantity' => 'required',
            'date'     => 'required'
        ]);

        $requested_date = Carbon::parse($request->date)->format('d');
        
        try{

            DB::beginTransaction();

                $inventory = Inventory ::where('date',Carbon::parse($request->date)->format('Y-m-d'))
                ->where('product_id',$request->product_id)
                ->where('unit_name',$request->unit_name)->get();

                // dd($inv[0]->purchase_stock);
                if(count($inventory)<=0)
                {
                
                    $inventory = new Inventory;
                    $inventory->date = Carbon::parse($request->date)->format('Y-m-d');
                    $inventory->product_id = $request->product_id;
                    $inventory->unit_name = $request->unit_name;
                    $inventory->opening_stock = $request->quantity;
                    $inventory->purchase_stock = 0;
                    $inventory->sell_stock = 0;
                    $inventory->closing_stock =  $inventory->opening_stock;
                    $inventory->save();

                }else{
                    $inv = Inventory::where('date',Carbon::parse($request->date)->format('Y-m-d'))
                                    ->where('product_id',$request->product_id)
                                    ->where('unit_name',$request->unit_name)
                                    ->update(['opening_stock' => $inventory[0]->opening_stock + $request->quantity ]);

                }   
                //Opening Stock
                
               
                
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
}

<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Product;
use App\Unit;
use App\Sell;
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
                    $inventory->productUnitId=$inventory->product_id.$inventory->unit_id;
                    // dd($inventory);
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

       // $lists =DB::select( DB::raw('select invent.productUnitId,products.product_name,invent.unit_name,
        //     sum(invent.quantity) as total_stock,total_sp,total_pp from invent 
        //     inner join products on products.product_id=invent.product_id
        //     left join 
        //     (select productUnitId,sum(quantity) as total_sp from sell_products group by productUnitId)
        //     sell_products on invent.productUnitId=sell_products.productUnitId 
        //     left join 
        //     (select productUnitId,sum(quantity) as total_pp from purchase_products group by productUnitId)
        //     purchase_products on purchase_products.productUnitId=invent.productUnitId 
        //     group by productUnitId,products.product_name,unit_name'));

        // $lists = DB::select( DB::raw('select sell_products.productUnitId,products.product_name,sell_products.unit_name,
        //             sum(sell_products.quantity) as total_sp,total_stock,total_pp from sell_products 
        //             inner join products on products.product_id=sell_products.product_id
        //             left join 
        //             (select productUnitId,sum(quantity) as total_stock from invent group by productUnitId)
        //             invent on invent.productUnitId=sell_products.productUnitId 
        //             left join 
        //             (select productUnitId,sum(quantity) as total_pp from purchase_products group by productUnitId)
        //             purchase_products on purchase_products.productUnitId=invent.productUnitId 
        //             group by productUnitId,products.product_name,unit_name'));

        // dd($lists);

        $current_date = Carbon::now()->format('Y-m-d');
        // dd($current_date);

        // $opening =DB::select( DB::raw('select sell_products.productUnitId,products.product_name,sell_products.unit_name,
        //                 sum(sell_products.quantity) as total_sp,total_stock,total_pp from sell_products
        //                 cross join sells on sells.sell_id = sell_products.sell_id 
        //                 inner join products on products.product_id=sell_products.product_id
        //                 left join 
        //                 (select productUnitId,sum(quantity) as total_stock from invent group by productUnitId)
        //                 invent on invent.productUnitId=sell_products.productUnitId 
        //                 left join 
        //                 (select productUnitId,sum(quantity) as total_pp from purchase_products group by productUnitId)
        //                 purchase_products on purchase_products.productUnitId=invent.productUnitId 
        //                 where sells.sell_date < "current_date"
        //                 group by productUnitId,products.product_name,unit_name'));

        // dd($opening);    
            

           
            // $sell = DB::table('sells')
            //             ->join('sell_products' ,'sells.sell_id','=','sell_products.sell_id')
            //             ->whereDate('sell_date','<', 'current_date')
            //             ->select('sell_products.product_id' ,'sells.sell_date')
            //             ->get();
            // dd($sell);

           $lists = Product::leftjoin('purchase_products','purchase_products.product_id','=','products.product_id')
            ->leftjoin('purchases','purchase_products.purchase_id','=','purchases.purchase_id')
            ->leftjoin('sell_products','sell_products.product_id','=','products.product_id')
            ->leftjoin('sells','sell_products.sell_id','=','sells.sell_id')
            ->leftjoin('invent','products.product_id','=','invent.product_id')
            ->where(function($q) use($current_date){
                $q->where('purchases.purchase_date','<',$current_date)
                ->orWhere('sells.sell_date','<',$current_date)
                ->orWhereNull('purchase_products.purchase_product_id')
                ->orWhereNull('sell_products.sell_products_id');
            })
            ->select('products.product_id','products.product_name',DB::raw('sum(purchase_products.quantity) as total_purchase , sum(sell_products.quantity) as total_sell , sum(invent.quantity) as total_invent'))->groupBy('products.product_id')

            ->get();

            // dd($product);
            foreach($lists as $list)
            {
                $purchase_quantity = PurchaseProduct::
                            leftjoin('purchases','purchase_products.purchase_id','=','purchases.purchase_id')
                            ->where('product_id' , $list->product_id)
                            ->whereDate('purchase_date' , $current_date)
                            ->sum('quantity');
                
                $sell_quantity = Sell_Product::
                                leftjoin('sells','sell_products.sell_id','=','sells.sell_id')
                                ->where('product_id' , $list->product_id)
                                ->whereDate('sell_date' , $current_date)
                                ->sum('quantity');

                $list->purchase_quantity = $purchase_quantity;
                $list->sell_quantity = $sell_quantity;
            }
            dd($lists);
     
        return view::make('app.inventory.turn')->with(['lists'=>$lists]);
    }

    public function turn_list(Request $request){

  
  
    }
}

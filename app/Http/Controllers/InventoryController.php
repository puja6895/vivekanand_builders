<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Product;
use App\Category;
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

            $current_date = Carbon::now()->format('Y-m-d');
        
            // $lists = Product::leftjoin('purchase_products','purchase_products.product_id','=','products.product_id')
            // ->leftjoin('purchases','purchase_products.purchase_id','=','purchases.purchase_id')
            // ->leftjoin('sell_products','sell_products.product_id','=','products.product_id')
            // ->leftjoin('sells','sell_products.sell_id','=','sells.sell_id')
            // ->leftjoin('invent','products.product_id','=','invent.product_id')
            // ->where(function($q) use($current_date){
            //     $q->where('purchases.purchase_date','<',$current_date)
            //     ->orWhere('sells.sell_date','<',$current_date)
            //     ->orWhereNull('purchase_products.purchase_product_id')
            //     ->orWhereNull('sell_products.sell_products_id');
            // })
            // ->select('products.product_id','products.product_name',DB::raw('sum(purchase_products.quantity) as total_purchase , sum(sell_products.quantity) as total_sell , sum(invent.quantity) as total_invent'))
            // ->groupBy('products.product_id')
            // ->get();
            $category = Category::where('category_name','Cement')
                                ->orwhere('category_name','Bricks')
                                ->get();
            // dd($category);
            $cement = '';
            $bricks = '';
            for($i = 0; $i < count($category) ; $i++){
                
                if($category[$i]->category_name == 'Cement'){
                    $cement = $category[$i]->category_id;
                }

                if($category[$i]->category_name == 'Bricks'){

                    $bricks = $category[$i]->category_id;
                }
            }


            $lists = Product::select('products.product_id','products.product_name')
                            ->where('category_id',$cement)
                            ->orwhere('category_id',$bricks)
                            ->get();
    
            // dd($lists);
            // dd($lists[4]->product_id);
            foreach($lists as $list)
            {
                $total_invent = Inventory::where('product_id', $list->product_id)->sum('quantity');

                $total_purchase = PurchaseProduct::leftjoin('purchases','purchase_products.purchase_id','=','purchases.purchase_id')
                                    ->where('product_id' , $list->product_id)
                                    ->whereDate('purchase_date' ,'<', $current_date)
                                    ->sum('quantity');
    
                $purchase_quantity = PurchaseProduct::leftjoin('purchases','purchase_products.purchase_id','=','purchases.purchase_id')
                            ->where('product_id' , $list->product_id)
                            ->whereDate('purchase_date' , $current_date)
                            ->sum('quantity');
                
                $total_sell = Sell_Product::leftjoin('sells','sell_products.sell_id','=','sells.sell_id')
                                ->where('product_id' , $list->product_id)
                                ->whereDate('sell_date' , '<',$current_date)
                                ->sum('quantity');
                // dd($total_sell);
                $sell_quantity = Sell_Product::leftjoin('sells','sell_products.sell_id','=','sells.sell_id')
                                ->where('product_id' , $list->product_id)
                                ->whereDate('sell_date' , $current_date)
                                ->sum('quantity');
                
                $list->total_invent = $total_invent;
                $list->total_purchase = $total_purchase;
                $list->total_sell = $total_sell;
                $list->purchase_quantity = $purchase_quantity;
                $list->sell_quantity = $sell_quantity;
            }
            // dd($lists);

     
        return view::make('app.inventory.turn')->with(['lists'=>$lists]);
    }

    public function turnList(Request $request){

        $this->validate($request, [
			// 'product_id' => 'required|exists:products,product_id',
			// 'unit_id' => 'required|exists:units,unit_id',
            // 'quantity' => 'required',
            'from_date'     => 'required'
        ]);

        try{

            $current_date = Carbon::now()->format('Y-m-d');
            $from_date = Carbon::parse($request->from_date)->format('Y-m-d');

            // dd( $from_date);
            // 
            $category = Category::where('category_name','Cement')
                                ->orwhere('category_name','Bricks')
                                ->get();
            // dd($category);
            $cement = '';
            $bricks = '';
            for($i = 0; $i < count($category) ; $i++){
                
                if($category[$i]->category_name == 'Cement'){
                    $cement = $category[$i]->category_id;
                }

                if($category[$i]->category_name == 'Bricks'){

                    $bricks = $category[$i]->category_id;
                }
            }


            $lists = Product::select('products.product_id','products.product_name')
                            ->where('category_id',$cement)
                            ->orwhere('category_id',$bricks)
                            ->get();
    
            // dd($lists);
            foreach($lists as $list)
            {
                $total_invent = Inventory::where('product_id', $list->product_id)->whereDate('date' ,'<=',$from_date)->sum('quantity');

                // dd( $total_invent);
    
                $total_purchase = PurchaseProduct::leftjoin('purchases','purchase_products.purchase_id','=','purchases.purchase_id')
                                    ->where('product_id' , $list->product_id)
                                    ->whereDate('purchase_date' ,'<', $from_date)
                                    ->sum('quantity');
                

                $purchase_quantity = PurchaseProduct::leftjoin('purchases','purchase_products.purchase_id','=','purchases.purchase_id')
                            ->where('product_id' , $list->product_id)
                            ->whereDate('purchase_date' , $from_date)
                            ->sum('quantity');
                            
                $total_sell = Sell_Product::leftjoin('sells','sell_products.sell_id','=','sells.sell_id')
                                ->where('product_id' , $list->product_id)
                                ->whereDate('sell_date' , '<',$from_date)
                                ->sum('quantity');
                                // dd( $total_sell);
                $sell_quantity = Sell_Product::leftjoin('sells','sell_products.sell_id','=','sells.sell_id')
                                ->where('product_id' , $list->product_id)
                                ->whereDate('sell_date' , $from_date)
                                ->sum('quantity');
    
                $list->total_invent = $total_invent;
                $list->total_purchase = $total_purchase;
                $list->total_sell = $total_sell;
                $list->purchase_quantity = $purchase_quantity;
                $list->sell_quantity = $sell_quantity;
            }

            
				// Return To Listing Page
                return redirect()->route('inventory.turn')->with(['lists'=>$lists]);
               
        }catch (Exception $exception) {
			DB::rollBack();
			return back()->with('error', $exception->getMessage())->withInput();
		}
        
  
    }
}

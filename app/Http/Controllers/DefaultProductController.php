<?php

namespace App\Http\Controllers;
use App\Unit;
use App\Product;
use App\Default_Product;
use Illuminate\Http\Request;
use DB;
use View;

class DefaultProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $default_products = Default_Product::all();
        return view::make('app.set_default.list')->with(['default_products'=>$default_products]);
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
        // dd($products);
        $units = Unit::all();
        return view::make('app.set_default.add')->with(['products'=>$products,'units'=>$units]);
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
        //Validate
		$this->validate($request, [
			'product_id' => 'required|exists:products,product_id',
			'unit_id' => 'required|exists:units,unit_id',
			'purchase_price' => 'required',
			'sell_price' => 'required',
		]);

		try {
			$is_present = Default_Product::where('product_id', $request->product_id)->where('unit_id', $request->unit_id)->count();

			if ($is_present > 0) {
				return back()->with('error', 'Product Default For this Unit Already Set, You Can Edit That.')->withInput();
			}
			// DB Transection Begin
			DB::beginTransaction();

			// Save Default Product Sell
			$default_product = new Default_Product;
			$default_product->product_id = $request->product_id;
			$default_product->unit_id = $request->unit_id;
			$default_product->purchase_price = $request->purchase_price;
			$default_product->sell_price = $request->sell_price;
			$default_product->save();

			DB::commit();
			// Return To Listing Page
			return redirect()->route('default_products')->with('success', 'Default Product  SuccessFully Set.');

		} catch (\Exception $e) {
			DB::rollBack();
			return back()->with('error', $e->getMessage())->withInput();
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Default_Product  $default_Product
     * @return \Illuminate\Http\Response
     */
    public function show(Default_Product $default_Product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Default_Product  $default_Product
     * @return \Illuminate\Http\Response
     */
    public function edit(Default_Product $default_Product,$id)
    {
        //
        
            $default_product=Default_Product::find($id);

            if($default_product){
                $products=Product::all();
                $units = Unit::all();
                return view::make('app.product.edit')->with(['products'=>$products,'units'=>$units]);
            }else {
                return back()->with('error','Invalid id');
            }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Default_Product  $default_Product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Default_Product $default_Product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Default_Product  $default_Product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Default_Product $default_Product)
    {
        //
    }
}

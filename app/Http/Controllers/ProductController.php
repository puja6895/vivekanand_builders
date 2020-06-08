<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use DB;
use View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $product = Product::withTrashed()->get();
        return view::make('app.product.list')->with(['products'=>$product]);;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view::make('app.product.add');
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
            'product_name'     => 'required',
           
        ]);
    
        try {
            //DB Transection
            DB::beginTransaction();

            $unit = new Product;
            $unit->product_name=$request->product_name;
            $unit->save();

            DB::commit();
            return redirect()->route('products')->with('success','Product Added');
            
        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();

        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product,$id)
    {
        //
        $result = Product::find($id);
        if($result){
        return view::make('app.product.edit')->with(['product'=>$result]);
        }else {
            return back()->with('error','Invalid id');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'product_id'    => 'required|exists:products',
            'product_name'     => 'required|unique:products',
            
            ]);
        try{    
            //DB Transaction
            DB::beginTransaction();

            $product = Product::find($request->product_id);
            $product->product_name=$request->product_name;
            $product->save();

            DB::commit();
            return redirect()->route('products')->with('success','Product updated');

        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}

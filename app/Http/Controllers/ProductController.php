<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
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
        $product = Product::withTrashed()->join('categories','products.category_id', '=', 'categories.category_id')->select('product_id','product_name','products.deleted_at','category_name')->get();
        // $categorie = Categorie::with
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
        $categories=Category::all();
        return view::make('app.product.add')->with(['categories'=>$categories]);
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
            'category_id'   => 'required|exists:categories',
           
        ]);
    
        try {
            //DB Transection
            DB::beginTransaction();

            $product = new Product;
            $product->product_name=$request->product_name;
            $product->category_id=$request->category_id;
            $product->save();

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
            $categories=Category::all();
            return view::make('app.product.edit')->with(['product'=>$result,'categories'=>$categories]);
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
            'category_id'   => 'required'
            
            ]);
        try{    
            //DB Transaction
            DB::beginTransaction();

            $product = Product::find($request->product_id);
            $product->product_name=$request->product_name;
            $product->category_id=$request->category_id;
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
    public function destroy(Product $product,$id)
    {
        //
         //
         try{
            //DB Transaction Begin
            DB:: beginTransaction();
            $products=Product::find($id);

            if($products){
                $products->delete();
                // $categorie->save();

                DB::commit();
                return redirect()->route('products')->with('success','Product Disable');
            }else{
                return back()->with('error','Invalid unit Id');
            }    

        }catch(Exception $exception){
                DB::rollBack();
                return back()->with('error',$exception->getMessage())->withInput();
            }
    }

    public function enable($id){
        try{
            // DB Transaction Begin
            DB::beginTransaction();
            $products=Product::withTrashed()->where('product_id', $id)->restore();
                DB::commit();

                // Return To Listing Page
                return redirect()->route('products')->with('success','Product Enable');
          

        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();
        }
    }    
}

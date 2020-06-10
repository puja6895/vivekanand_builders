<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories=Category::withTrashed()->get();
        return view::make('app.categories.list')->with(['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view::make('app.categories.add');
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
        Validator::make($request->all(), [
            'category_name'     => 'required',
        ])->validate();
        try{
        //DB Transaction
        DB::beginTransaction();
        
        $category = new Category;
        $category->category_name=$request->category_name;
        $category->save();

            DB::commit();
            return redirect()->route('categories')->with('success','Category Added');
            
        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();

        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category,$id)
    {
        //
        $result= Category::find($id);
        if($result){
            return view::make('app.categories.edit')->with(['categories'=>$result]);
        }else{
            return back()->with('error','Invalid Id');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        $this->validate($request, [
            'category_id'       =>'required|exists:categories',
            'category_name'     => 'required|unique:categories',
            ]);
            try {
            //DB Transaction
                DB::beginTransaction();

                $category = Category::find($request->category_id);
                $category->category_name = $request->category_name;
                $category->save();
                
                DB::commit();

                return redirect()->route('categories')->with('success','Category Updated');

            }catch(Exception $exception){
                DB::rollBack();
                return back()->with('error',$exception->getMessage())->withInput();
    
            }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category,$id)
    {
        //
        try{
            //DB Transaction Begin
            DB:: beginTransaction();
            $categories=Category::find($id);

            if($categories){
                $categories->delete();
                // $categorie->save();

                DB::commit();
                return redirect()->route('categories')->with('success','Category Disable');
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
            $categories=Category::withTrashed()->where('category_id', $id)->restore();
                DB::commit();

                // Return To Listing Page
                return redirect()->route('categories')->with('success','Category Enable');
          

        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();
        }
    }    
}

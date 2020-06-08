<?php

namespace App\Http\Controllers;

use App\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use View;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categorie = Categorie::withTrashed()->get();
        return view::make('app.categories.list')->with(['categories'=>$categorie]);
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
            'categorie_name'     => 'required',
        ])->validate();
        try{
        //DB Transaction
        DB::beginTransaction();
        
        $categorie = new Categorie;
        $categorie->categorie_name=$request->categorie_name;
        $categorie->save();

            DB::commit();
            return redirect()->route('categories')->with('success','Categorie Added');
            
        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();

        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit(Categorie $categorie,$id)
    {
        $result= Categorie::find($id);
        if($result){
            return view::make('app.categories.edit')->with(['categorie'=>$result]);
        }else{
            return back()->with('error','Invalid Id');
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categorie $categorie)
    {
            $this->validate($request, [
            'categorie_id'       =>'required|exists:categories',
            'categorie_name'     => 'required|unique:categories',
            ]);
            try {
            //DB Transaction
                DB::beginTransaction();

                $categorie = Categorie::find($request->categorie_id);
                $categorie->categorie_name = $request->categorie_name;
                $categorie->save();
                
                DB::commit();

                return redirect()->route('categories')->with('success','Categorie Updated');

            }catch(Exception $exception){
                DB::rollBack();
                return back()->with('error',$exception->getMessage())->withInput();
    
            }  


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorie $categorie,$id)
    {
        //
        try{
            //DB Transaction Begin
            DB:: beginTransaction();
            $categorie=Categorie::find($id);

            if($categorie){
                $categorie->delete();
                // $categorie->save();

                DB::commit();
                return redirect()->route('categories')->with('success','Categorie Disable');
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
            $categorie=Categorie::withTrashed()->where('categorie_id', $id)->restore();
                DB::commit();

                // Return To Listing Page
                return redirect()->route('categories')->with('success','Categories Enable');
          

        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();
        }
    }    

}

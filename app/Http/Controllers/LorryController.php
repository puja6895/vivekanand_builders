<?php

namespace App\Http\Controllers;

use App\Lorry;
use Illuminate\Http\Request;
use View;
use DB;

class LorryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lorries = Lorry::all();
        return view::make('app.lorry.list')->with('lorries',$lorries);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view::make('app.lorry.add');
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
            'lorry_no'     => 'required',
           
        ]);
    
    try {
        //DB Transection
        DB::beginTransaction();
        // dd($request->lorry_name);
        $lorry = new Lorry;
        $lorry->lorry_no=$request->lorry_no;
        $lorry->save();
        

        DB::commit();
        return redirect()->route('lorries')->with('success','Lorry Added');
        
    }catch(Exception $exception){
        DB::rollBack();
        return back()->with('error',$exception->getMessage())->withInput();

    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lorry  $lorry
     * @return \Illuminate\Http\Response
     */
    public function show(Lorry $lorry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lorry  $lorry
     * @return \Illuminate\Http\Response
     */
    public function edit(Lorry $lorry,$id)
    {
        //
        // dd($id);
        $result= Lorry::find($id);
        dd($result);

        if($result){
            
            return view::make('app.lorry.edit')->with(['lorry'=>$result]);
        }else{
            return back()->with('error','Invalid Id');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lorry  $lorry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lorry $lorry)
    {
        //
        $this->validate($request, [
            'lorry_id'       =>'required|exists:lorries',
            'lorry_no'     => 'required|unique:lorries',

            
           
        ]);
    
        try {
            //DB Transection
            DB::beginTransaction();

            $lorry = Lorry::find($request->lorry_id);
            $lorry->lorry_id=$request->lorry_no;
            $ulorrynit->save();

            DB::commit();
            return redirect()->route('lorryies')->with('success','Lorry Updated');
            
        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lorry  $lorry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lorry $lorry)
    {
        //
    }
}

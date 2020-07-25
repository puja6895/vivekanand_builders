<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;
use View;
use DB;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $unit = Unit::withTrashed()->latest('deleted_at')->get();
        return view::make('app.unit.list')->with(['unit'=>$unit]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view::make('app.unit.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
                'unit_name'     => 'required',
               
            ]);
        
        try {
            //DB Transection
            DB::beginTransaction();

            $unit = new Unit;
            $unit->unit_name=$request->unit_name;
            $unit->save();

            DB::commit();
            return redirect()->route('units')->with('success','Unit Added');
            
        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();

        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit,$id)
    {
        //
        
        $result= Unit::find($id);
        if($result){
            
            return view::make('app.unit.edit')->with(['unit'=>$result]);
        }else{
            return back()->with('error','Invalid Id');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        //
        $this->validate($request, [
            'unit_id'       =>'required|exists:units',
            'unit_name'     => 'required|unique:units',

            
           
        ]);
    
        try {
            //DB Transection
            DB::beginTransaction();

            $unit = Unit::find($request->unit_id);
            $unit->unit_name=$request->unit_name;
            $unit->save();

            DB::commit();
            return redirect()->route('units')->with('success','Unit Updated');
            
        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit,$id)
    {
        try{
            //DB Transaction Begin
            DB:: beginTransaction();
            $unit=Unit::find($id);

            if($unit){
                $unit->delete();
                $unit->save();

                DB::commit();
                return redirect()->route('units')->with('success','Unit Disable');
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
            $unit=Unit::withTrashed()->where('unit_id', $id)->restore();
            // if($unit){
                // $unit->restore();
                // $unit->save();
        
                DB::commit();

                // Return To Listing Page
                return redirect()->route('units')->with('success','Unit Enable');
            // }
            // else{
                // return back()->with('error','Invalid customer Id');
            // }

        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();
        }

    }
}

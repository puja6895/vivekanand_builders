<?php

namespace App\Http\Controllers;

use App\Purchaser;
use Illuminate\Http\Request;
use View;
use DB;

class PurchaserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $purchasers = DB::table('purchasers')->where('isDeleted','0')->get();
        $purchaser_disabled = Purchaser::where('isDeleted','1')->get();

        return View::make('app.purchaser.list')->with(['purchasers'=>$purchasers,'purchaser_disabled'=>$purchaser_disabled]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View::make('app.purchaser.add');
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
            'purchaser_name' => 'required',
            
        ]);

        try{
            // DB Transaction Begin
            DB::beginTransaction();

            // Save Customer
            $purchaser = new Purchaser;
            $purchaser->purchaser_name = $request->purchaser_name;
            $purchaser->purchaser_email = $request->purchaser_email;
            $purchaser->purchaser_mobile = $request->purchaser_mobile;
            $purchaser->purchaser_address = $request->purchaser_address;
            $purchaser->company = $request->company_name;
            $purchaser->save();

            DB::commit();
            // Return To Listing Page
            return redirect()->route('purchasers')->with('success','Purchaser added');
            
        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Purchaser  $purchaser
     * @return \Illuminate\Http\Response
     */
    public function show(Purchaser $purchaser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchaser  $purchaser
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchaser $purchaser,$id)
    {
        //
        $result= Purchaser::find($id);
        if($result){
             return view::make('app.purchaser.edit')->with(['purchaser'=>$result]);
        }else{
            return back()->with('error','Invalid Id');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchaser  $purchaser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchaser $purchaser)
    {
        //
        $this->validate($request, [
            'purchaser_id'     => 'required|exists:purchasers',
            'purchaser_name'     => 'required',
            // 'customer_mobile'     => 'required|unique:customers,customer_mobile,'.$request->customer_id.',customer_id',
        ]);

        try{
            // dd($request->purchaser_id);
            // DB Transection Begin
            DB::beginTransaction();

            // Save Customer
            $purchaser = Purchaser::find($request->purchaser_id);
            $purchaser->purchaser_name = $request->purchaser_name;
            $purchaser->purchaser_email = $request->purchaser_email;
            $purchaser->purchaser_mobile = $request->purchaser_mobile;
            $purchaser->purchaser_address = $request->purchaser_address;
            $purchaser->company = $request->company_name;
            $purchaser->save();

            DB::commit();
            // Return To Listing Page
            return redirect()->route('purchasers')->with('success','Purchaser updated');

        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchaser  $purchaser
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchaser $purchaser,$id)
    {
        //
        try{
            // DB Transection Begin
            DB::beginTransaction();
            $purchaser=Purchaser::find($id);
            if($purchaser){
                $purchaser->isDeleted=1;
                $purchaser->save();
        
                DB::commit();

                // Return To Listing Page
                return redirect()->route('purchasers')->with('success','Purchaser Disabled');
            }else{
                return back()->with('error','Invalid Purchaser Id');
            }

        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();
        }
    }

    public function enable($id){
        try{
            // DB Transection Begin
            DB::beginTransaction();
            $purchaser=Purchaser::find($id);
            if($purchaser){
                $purchaser->isDeleted=0;
                $purchaser->save();
        
                DB::commit();

                // Return To Listing Page
                return redirect()->route('purchasers')->with('success','Purchaser Enable');
            }else{
                return back()->with('error','Invalid Puchaser Id');
            }

        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();
        }

    }
}

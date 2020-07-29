<?php

namespace App\Http\Controllers;

use App\LorryReport;
use App\Customer;
use App\Product;
use App\Unit;
use App\Lorry;
use Illuminate\Http\Request;
use Carbon\Carbon;
use View;
use DB;

class LorryReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lorry_reports = LorryReport::all();
        // dd($lorry_reports[0]->advance_amount);
        // $final_amount = ($lorry_reports[0]->amount - $lorry_reports[0]->advance_amount);
        return view::make('app.lorry_report.list')->with(['lorry_reports'=>$lorry_reports]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $customers = Customer::where('isDeleted',0)->get();
        $lorries = Lorry::all();
        // dd($lorry);
        $products = Product::all();
        $units = Unit::all();
        return view::make('app.lorry_report.add')->with(['customers'=>$customers,'products'=>$products,'units'=>$units,'lorries'=>$lorries]);
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
            'customer_id' => 'required|exists:customers,customer_id',
            'lorry_id' => 'required|exists:lorries,lorry_id',
            'product_id' => 'required|exists:products,product_id',
            'unit_id' => 'required|exists:units,unit_id',
            'advance_amount' =>'required',
            'date' => 'required',
			'from' => 'required',
			'to' => 'required',
			'weight' => 'required',
			'rate' => 'required',
			// 'amount' => 'required',
        ]);
            // dd($request->lorry_id);
        try{
            // DB Transaction Begin
            DB::beginTransaction();

            $weight = $request->weight;
            $rate = $request->rate;
            $amount = $weight * $rate;

            // Save Customer
            $lorry_report = new LorryReport;
            $lorry_report->customer_id = $request->customer_id;
            $lorry_report->lorry_date = Carbon::parse($request->date)->format('Y-m-d');
            $lorry_report->lorry_id = $request->lorry_id;
            $lorry_report->product_id = $request->product_id;
            $lorry_report->from = $request->from;
            $lorry_report->to = $request->to;
            $lorry_report->unit_id = $request->unit_id;
            $lorry_report->weight = $weight;
            $lorry_report->rate = $rate;
            $lorry_report->amount = $amount;
            $lorry_report->advance_amount = $advance_amount;
            $lorry_report->save();

            DB::commit();
            // Return To Listing Page
            return redirect()->route('lorry_reports')->with('success','Lorry Report Added');
            
        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LorryReport  $lorryReport
     * @return \Illuminate\Http\Response
     */
    public function show(LorryReport $lorryReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LorryReport  $lorryReport
     * @return \Illuminate\Http\Response
     */
    public function edit(LorryReport $lorryReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LorryReport  $lorryReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LorryReport $lorryReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LorryReport  $lorryReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(LorryReport $lorryReport)
    {
        //
    }
}

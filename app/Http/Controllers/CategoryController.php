<?php

namespace App\Http\Controllers;

use App\Category;
use App\Customer;
use App\Purchaser;
use App\PreviousDue;
use App\PurchaserPreDue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use View;
use Carbon\Carbon;

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
    
    public function list(){

        $lists = PreviousDue :: all();
        return view::make('app.previousDue.list')->with(['lists'=>$lists]);
    }

    public function add(){

        $customers = Customer:: all();

        return view::make('app.previousDue.add')->with(['customers'=>$customers]);
    }

    public function previousdue_store(Request $request){
        // dd($request);
        $this->validate($request, [
			'customer_id' => 'required|exists:customers,customer_id',
			// 'unit_id' => 'required|exists:units,unit_id',
			// 'purchase_price' => 'required',
			// 'sell_price' => 'required',
        ]);
        
        try{

            DB:: beginTransaction();

            $previous_due = new PreviousDue;
            $previous_due->customer_id = $request->customer_id;
            $previous_due->previous_due_date = Carbon::parse($request->previous_due_date)->format('Y-m-d');
            $previous_due->previous_due_amount = $request->previous_due_amount;
            $previous_due->save();

            DB::commit();

            return redirect()->route('previous_due')->with('success','Previous Due Added');
        
        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();

        }   
    }

    public function preDueList(Request $request){
        
        $lists = PurchaserPreDue :: all();
        return view::make('app.previousDue.purchase.list')->with(['lists'=>$lists]);
    }

    public function pre_due_add(Request $requset){
        $purchasers = Purchaser:: select('purchaser_id','purchaser_name')->get();

        return view::make('app.previousDue.purchase.add')->with(['purchasers'=>$purchasers]);
    }

    public function store_pre_due(Request $request){
        //  dd($request);
         $this->validate($request, [
			'purchaser_id' => 'required',
			// 'unit_id' => 'required|exists:units,unit_id',
			// 'purchase_price' => 'required',
			// 'sell_price' => 'required',
        ]);
        
        try{

            DB:: beginTransaction();

            $previous_due = new PurchaserPreDue;
            $previous_due->purchaser_id = $request->purchaser_id;
            $previous_due->previous_due_date = Carbon::parse($request->previous_due_date)->format('Y-m-d');
            $previous_due->previous_due_amount = $request->previous_due_amount;
            $previous_due->save();

            DB::commit();

            return redirect()->route('purcahse_pre_due')->with('success','Previous Due Added');
        
        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();

        }  
    }

    public function delete($id)
    {
        //
        // dd($id);
        try{
            //DB Transaction Begin
            DB:: beginTransaction();
            $previous_due = PreviousDue::where('id',$id);

            if($previous_due){
                $previous_due->delete();
                // $default_Product->save();

                DB::commit();
                return redirect()->route('previous_due')->with('success','Previous Due Deleted');
            }else{
                return back()->with('error','Invalid unit Id');
            }    

        }catch(Exception $exception){
                DB::rollBack();
                return back()->with('error',$exception->getMessage())->withInput();
        }
    }
}

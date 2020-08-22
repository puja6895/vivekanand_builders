<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Sell;
use App\Payment;
use App\PreviousDue;
use App\Sell_Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use View;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customers = DB::table('customers')->where('isDeleted','0')->get();
        $customers_disabled = Customer::where('isDeleted','1')->get();

        return View::make('app.customer.list')->with(['customers'=>$customers,'customers_disabled'=>$customers_disabled]);
        // return view::make('app.customer.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View::make('app.customer.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

                //Validate
                // $this->validate($request, [
                //     'customer_name'     => 'required',
                //     'customer_mobile'     => 'required|unique:customers|digits:10',
                // ]);
                Validator::make($request->all(), [
                    'customer_name'     => 'required',
                    // 'customer_mobile'     => 'required|unique:customers|digits:10'
                ])->validate();

        try{
            // DB Transaction Begin
            DB::beginTransaction();

            // Save Customer
            $customer = new Customer;
            $customer->customer_name = $request->customer_name;
            $customer->customer_email = $request->customer_email;
            $customer->customer_mobile = $request->customer_mobile || 0;
            $customer->customer_address = $request->customer_address;
            $customer->gst_no = $request->gst_no;
            $customer->save();

            DB::commit();
            // Return To Listing Page
            return redirect()->route('customers')->with('success','Customer added');
            
        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer,$id)
    {
        //
        $result= Customer::find($id);
        if($result){
             return view::make('app.customer.edit')->with(['customer'=>$result]);
        }else{
            return back()->with('error','Invalid Id');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
        $this->validate($request, [
            'customer_id'     => 'required|exists:customers',
            'customer_name'     => 'required',
            'customer_mobile'     => 'required|unique:customers,customer_mobile,'.$request->customer_id.',customer_id',
        ]);

            // dd($request->customer_id);
        try{
            // DB Transection Begin
            DB::beginTransaction();

            // Save Customer
            $customer = Customer::find($request->customer_id);
            $customer->customer_name = $request->customer_name;
            $customer->customer_email = $request->customer_email;
            $customer->customer_mobile = $request->customer_mobile;
            $customer->customer_address = $request->customer_address;
            $customer->gst_no = $request->gst_no;
            $customer->save();

            DB::commit();
            // Return To Listing Page
            return redirect()->route('customers')->with('success','Customer updated');

        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer,$id)
   {
        try{
            // DB Transection Begin
            DB::beginTransaction();
            $customer=Customer::find($id);
            
            if($customer){
                $customer->isDeleted=1;
                $customer->save();

                $find_sell = Sell::where('customer_id', $customer->customer_id);
                $sells = $find_sell->get();
                foreach ($sells as $sell) {
                    $sell->sell_products()->delete();
                    $sell->delete();
                }
        
                DB::commit();

                // Return To Listing Page
                return redirect()->route('customers')->with('success','Customer Disabled');
            }else{
                return back()->with('error','Invalid customer Id');
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
            $customer=Customer::find($id);
            if($customer){
                $customer->isDeleted=0;
                $customer->save();
        
                DB::commit();

                // Return To Listing Page
                return redirect()->route('customers')->with('success','Customer Enable');
            }else{
                return back()->with('error','Invalid customer Id');
            }

        }catch(Exception $exception){
            DB::rollBack();
            return back()->with('error',$exception->getMessage())->withInput();
        }

    }

    public function list(){

        $lists =DB::select( DB::raw('select customers.customer_id,customers.customer_name,previous_due.previous_due_amount,sum(sells.total_amount) as total_amount,total_payment from customers inner join sells on customers.customer_id=sells.customer_id left join previous_due on customers.customer_id = previous_due.customer_id left join (select customer_id,sum(pay_received) as total_payment from sell_payAmounts group by customer_id)sell_payAmounts on sell_payAmounts.customer_id=customers.customer_id where isDeleted = 0 group by customer_id , previous_due_amount'));

        // $previous_due_amount = $lists->previous_due_amount ;
        // dd($previous_due_amount);

        $sell_total_amount = Sell :: sum('total_amount');

        $payment_total_amount = Payment :: sum('pay_received');

        // $previous_due_amount = PreviousDue :: sum('previous_due_amount');

        // dd($previous_due_amount);

        $total_due_amount = $sell_total_amount - $payment_total_amount;

        // dd($total_due_amount);
        
        return view::make('app.customer.customer_list')->with(['lists'=>$lists , 'sell_total_amount'=>$sell_total_amount, 'payment_total_amount'=>$payment_total_amount,'total_due_amount'=>$total_due_amount]);
    }
}

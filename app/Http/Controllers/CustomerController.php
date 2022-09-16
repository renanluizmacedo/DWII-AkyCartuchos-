<?php

namespace App\Http\Controllers;

use App\Models\Address;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();

        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $addresses = Address::all();
        return view('customers.create', compact('addresses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $address = Address::find($request->address);

        if (isset($address)) {

            $customer = new Customer();
            $customer->name = mb_strtoupper($request->name, 'UTF-8');
            $customer->phone = $request->phone;
            $customer->address()->associate($address);

            $customer->save();

            return redirect()->route('customers.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {

        $address = Address::find($customer->address_id);

        return view('customers.show', compact(['customer', 'address']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $addresses = Address::all();

        if (isset($customer)) {
            return view('customers.edit', compact(['customer', 'addresses']));
        }

        return "<h1>Cliente não Encontrado!</h1>";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {

        $address = Address::find($request->address);

        $customer->name = mb_strtoupper($request->name, 'UTF-8');
        $customer->phone = $request->phone;
        //   $customer->email = $request->name;
        $customer->address()->associate($address);

        $customer->save();


        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreserviceOrderRequest;
use App\Http\Requests\UpdateserviceOrderRequest;
use App\Models\serviceOrder;
use App\Models\item;
use Illuminate\Http\Request;

class ServiceOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('serviceOrder.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $so = session('serviceOrder');

        $items =  item::all();

        return view('serviceOrder.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreserviceOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->botaoSession != null) {
            $this->sessionServiceOrder($request);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\serviceOrder  $serviceOrder
     * @return \Illuminate\Http\Response
     */
    public function show(serviceOrder $serviceOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\serviceOrder  $serviceOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(serviceOrder $serviceOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateserviceOrderRequest  $request
     * @param  \App\Models\serviceOrder  $serviceOrder
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateserviceOrderRequest $request, serviceOrder $serviceOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\serviceOrder  $serviceOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(serviceOrder $serviceOrder)
    {
        //
    }
    public function sessionServiceOrder(Request $request)
    {

        $sess = array();

        //if ($sess != null) {
        $sess['name'] = $request->name;
        $sess['phone'] = $request->phone;



        if (array_key_exists('item', $sess)) {

            $sess['item'] = ['item' => $request->item];
        } else if(!array_key_exists('item', $sess))  {
            $sess['item'] = array();
        }

        dd($sess);
        //   }

        session(['serviceOrder' => $sess]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateserviceOrderRequest;
use App\Models\serviceOrder;
use App\Models\item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ServiceOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sess = session('serviceOrder');

        $sess['name'] = '';
        $sess['phone'] = '';
        $sess['note'] = '';
        $sess['item'] = array();
        $sess['route_action'] = Route::currentRouteName();


        session(['serviceOrder' => $sess]);

        return view('serviceOrder.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $serviceOrdemSession = session('serviceOrder');

        $items_session = [];

        if ($serviceOrdemSession != null) {
            if (array_key_exists('item', $serviceOrdemSession)) {
                $i = 0;

                foreach ($serviceOrdemSession['item'] as $it) {
                    if (Item::find($it) != null) {
                        $items_session[$i] = Item::find($it);
                    }
                    $i++;
                }
            }
        }

        $items =  item::all();

        return view('serviceOrder.create', compact(['items', 'items_session', 'serviceOrdemSession']));
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
            Self::sessionServiceOrder($request);
            return redirect()->route('serviceOrder.create');
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

        $sess = session('serviceOrder');

        $sess['name'] = $request->name;
        $sess['phone'] = $request->phone;
        $sess['note'] = $request->note;

        $sess['route_action'] = Route::currentRouteName();
        array_push($sess['item'], $request->item);

        session(['serviceOrder' => $sess]);
    }

}

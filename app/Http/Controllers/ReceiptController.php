<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReceiptRequest;
use App\Http\Requests\UpdateReceiptRequest;
use App\Models\Receipt;
use App\Models\Item;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Route;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sess = session('receipt');

        $sess['name'] = '';
        $sess['phone'] = '';
        $sess['note'] = '';
        $sess['item'] = array();
        $sess['route_action'] = Route::currentRouteName();


        session(['receipt' => $sess]);
        
        return view('receipts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $receiptSession = session('receipt');

        $items_session = [];

        if ($receiptSession != null) {
            if (array_key_exists('item', $receiptSession)) {
                $i = 0;

                foreach ($receiptSession['item'] as $it) {
                    if (Item::find($it) != null) {
                        $items_session[$i] = Item::find($it);
                    }
                    $i++;
                }
            }
        }

        $items =  item::all();

        return view('receipts.create', compact(['items', 'items_session', 'receiptSession']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReceiptRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReceiptRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function show(Receipt $receipt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function edit(Receipt $receipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReceiptRequest  $request
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReceiptRequest $request, Receipt $receipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receipt $receipt)
    {
        //
    }
    public function sessionReceipt(Request $request)
    {

        $sess = session('receipt');

        $sess['name'] = $request->name;
        $sess['phone'] = $request->phone;
        $sess['note'] = $request->note;

        $sess['route_action'] = Route::currentRouteName();
        array_push($sess['item'], $request->item);

        session(['receipt' => $sess]);
    }
}

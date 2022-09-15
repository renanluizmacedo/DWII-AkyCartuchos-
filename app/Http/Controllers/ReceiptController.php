<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateReceiptRequest;
use App\Models\Receipt;
use App\Models\ReceiptItem;
use App\Models\item;
use App\Models\Customer;

use Illuminate\Http\Request;

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

        $sess['customer_id'] = '';
        $sess['name'] = '';
        $sess['phone'] = '';
        $sess['note'] = '';
        $sess['item'] = array();
        $sess['route_action'] = Route::currentRouteName();

        session(['receipt' => $sess]);
        $receipts = Receipt::with(['customer'])->get();

        return view('receipts.index', compact('receipts'));
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
                    if (item::find($it) != null) {
                        $items_session[$i] = Item::find($it);
                    }
                    $i++;
                }
            }
        }

        $items =  item::all();
        $customers =  Customer::all();

        return view('receipts.create', compact(['items', 'items_session', 'receiptSession', 'customers']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReceiptRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->botaoSession != null) {
            $this->sessionReceipt($request);
            return redirect()->route('receipts.create');
        }

        $receipt = $this->storeReceipt($request);
        $items = $this->selectedItems($request->SELECTED_ITEMS);

        $index = 0;
        foreach ($items as $item) {

            $receiptItem = new ReceiptItem();
            $receiptItem->receipt()->associate($receipt);
            $receiptItem->item()->associate($item);
            $receiptItem->amount = $request->AMOUNT_ITEM[$index];

            $receiptItem->save();
            $index++;
        }

        return redirect()->route('receipts.index');
    }
    public function storeReceipt($request)
    {
        $receipt = new Receipt();
        $items = $this->selectedItems($request->SELECTED_ITEMS);

        $receipt->observation = mb_strtoupper($request->note, 'UTF-8');;
        $receipt->totalPrice = $this->sumPrice($items);

        $customer = Customer::find($request->customer_id);

        if (isset($customer)) {
            $receipt->customer()->associate($customer);
        }

        $receipt->save();

        return $receipt;
    }
    public function sumPrice($items)
    {
        $sum = 0;
        foreach ($items as $i) {
            $sum = $i->price + $sum;
        }
        return $sum;
    }
    public function selectedItems($SELECTED_ITEMS)
    {
        $items = array();
        $index = 0;
        foreach ($SELECTED_ITEMS as $select_item) {
            $item = item::find($select_item);

            if (isset($item)) {
                $items[$index] = $item;
                $index++;
            }
        }
        return $items;
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
    public function customerReceipt(Request $request)
    {

        $customer = Customer::find($request->customer);


        $sess = session('receipt');

        $sess['customer_id'] = $customer->id;
        $sess['name'] = mb_strtoupper($customer->name, 'UTF-8');
        $sess['phone'] = $customer->phone;

        session(['receipt' => $sess]);

        return redirect()->route('receipts.create');
    }
    public function sessionReceipt(Request $request)
    {

        $sess = session('receipt');

        $sess['note'] = mb_strtoupper($request->note, 'UTF-8');

        if (!in_array($request->item, $sess['item'])) {
            array_push($sess['item'], $request->item);
        }

        $sess['route_action'] = Route::currentRouteName();
        session(['receipt' => $sess]);
    }
}

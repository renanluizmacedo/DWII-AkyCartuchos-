<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateReceiptRequest;
use App\Models\Receipt;
use App\Models\ReceiptItem;
use App\Models\Item;
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

    public function __construct()
    {
        $this->authorizeResource(Receipt::class, 'receipt');
    }
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
        Self::alertDismiss();
        Self::alertDismissEmptyList();

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

            Self::sessionReceipt($request);

            return redirect()->route('receipts.create');
        }
        self::validation($request);

        if (!isset($request->SELECTED_ITEMS)) {
            $sess = session('receipt');

            $sess['emptyList'] = 1;
            session(['receipt' => $sess]);

            return redirect()->route('receipts.create');
        }
        
        $receipt = Self::storeReceipt($request);
        $items = Self::selectedItems($request->SELECTED_ITEMS);


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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function show(Receipt $receipt)
    {
        $receiptItems = ReceiptItem::with(['item' => function ($q) {
            $q->withTrashed();
        }])->where('receipt_id', $receipt->id)->get();

        return view('receipts.show', compact(['receipt', 'receiptItems']));
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
        if (isset($receipt)) {
            $receipt->delete();
        }
        return redirect()->route('receipts.index');
    }
    public function removeItemTable($idItem)
    {

        $sess = session('receipt');

        $newItems = array();
        foreach ($sess['item'] as $i) {
            if ($idItem != $i) {
                array_push($newItems, $i);
            }
        }
        $sess['item'] = $newItems;

        if (array_key_exists('itemInserted', $sess)) {
            unset($sess['itemInserted']);
        }
        Self::alertDismissEmptyList();

        $sess['itemRemoved'] = 1;

        session(['receipt' => $sess]);

        return redirect()->route('receipts.create');
    }
    public function alertDismiss()
    {
        $sess = session('receipt');

        if (array_key_exists('itemInserted', $sess)) {
            unset($sess['itemInserted']);
        }
        if (array_key_exists('itemRemoved', $sess)) {
            unset($sess['itemRemoved']);
        }

        session(['receipt' => $sess]);
    }
    public function alertDismissEmptyList()
    {
        $sess = session('receipt');
        if (array_key_exists('emptyList', $sess)) {
            unset($sess['emptyList']);
        }
        session(['receipt' => $sess]);
    }
    public function customerReceipt(Request $request)
    {

        $customer = Customer::find($request->customer);

        $sess = session('receipt');

        $sess['customer_id'] = $customer->id;
        $sess['name'] = mb_strtoupper($customer->name, 'UTF-8');

        Self::alertDismiss();
        Self::alertDismissEmptyList();


        $sess['phone'] = $customer->phone;
        session(['receipt' => $sess]);

        return redirect()->route('receipts.create');
    }
    public function sessionReceipt(Request $request)
    {

        $sess = session('receipt');

        $sess['note'] = mb_strtoupper($request->note, 'UTF-8');

        Self::alertDismiss();
        Self::alertDismissEmptyList();

        if (!in_array($request->item, $sess['item'])) {
            array_push($sess['item'], $request->item);
            $sess['itemInserted'] = 1;
        } else {
            $sess['itemInserted'] = 0;
        }

        $sess['route_action'] = Route::currentRouteName();
        session(['receipt' => $sess]);
    }
    public function storeReceipt($request)
    {
        $receipt = new Receipt();
        $items = Self::selectedItems($request->SELECTED_ITEMS);

        $receipt->observation = mb_strtoupper($request->note, 'UTF-8');;
        $receipt->totalPrice = Self::sumPrice($items, $request);

        $customer = Customer::find($request->customer_id);

        if (isset($customer)) {
            $receipt->customer()->associate($customer);
        }

        $receipt->save();

        return $receipt;
    }
    public function sumPrice($items, $request)
    {
        $index = 0;

        foreach ($items as $i) {
            if ($request->AMOUNT_ITEM[$index] != 1) {
                $i->price = $i->price * $request->AMOUNT_ITEM[$index];
            }
            $index++;
        }

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
            $item = Item::find($select_item);

            if (isset($item)) {
                $items[$index] = $item;
                $index++;
            }
        }

        return $items;
    }
    public function validation(Request $request)
    {

        $rules = [
            'name' => 'required|max:100|min:5',
            'phone' => 'required',
            'note' => 'required',
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] ?? obrigat??rio!",
            "max" => "O campo [:attribute] possui tamanho m??ximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho m??nimo de [:min] caracteres!",
            "unique" => "O campo [:attribute] pode ter apenas um ??nico registro!"
        ];

        $request->validate($rules, $msgs);
    }
}

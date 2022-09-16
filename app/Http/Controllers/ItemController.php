<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreitemRequest;
use App\Http\Requests\UpdateitemRequest;
use App\Models\item;
use App\Models\itemType;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items =  item::orderBy('name','desc')->get();

        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $itemType =  itemType::all();

        return view('items.create', compact('itemType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreitemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $itemType = itemType::find($request->type_item);

        if (isset($itemType)) {

            $item = new Item();

            $item->name = mb_strtoupper($request->name, 'UTF-8');
            $item->serial_number = $request->serial_number;
            $item->price = $request->price;
            $item->itemType()->associate($itemType);

            $item->save();

            return redirect()->route('items.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(item $item)
    {
        $itemType =  itemType::find($item->item_type_id);

        return view('items.show', compact(['item','itemType']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(item $item)
    {
        $itemType =  itemType::all();

        return view('items.edit', compact(['item', 'itemType']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateitemRequest  $request
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, item $item)
    {

        $itemType = itemType::find($request->type_item);

        if (isset($itemType)) {
            $item->name = mb_strtoupper($request->name, 'UTF-8');
            $item->price = $request->price;
            $item->serial_number = $request->serial_number;
            $item->itemType()->associate($itemType);

            $item->save();

            return redirect()->route('items.index');
        }

        return "<h1>Item não Encontrado!</h1>";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(item $item)
    {
        //
    }
}

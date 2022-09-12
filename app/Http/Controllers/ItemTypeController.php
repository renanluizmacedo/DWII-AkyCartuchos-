<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreitemTypeRequest;
use App\Http\Requests\UpdateitemTypeRequest;
use App\Models\itemType;
use Illuminate\Http\Request;

class ItemTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
      //  $this->authorizeResource(itemType::class, 'itemsType');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreitemTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item_type = new itemType();

        $item_type->name = mb_strtoupper($request->item_type, 'UTF-8');

        $item_type->save();

        return redirect()->route('items.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\itemType  $itemType
     * @return \Illuminate\Http\Response
     */
    public function show(itemType $itemType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\itemType  $itemType
     * @return \Illuminate\Http\Response
     */
    public function edit(itemType $itemType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateitemTypeRequest  $request
     * @param  \App\Models\itemType  $itemType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateitemTypeRequest $request, itemType $itemType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\itemType  $itemType
     * @return \Illuminate\Http\Response
     */
    public function destroy(itemType $itemsType)
    {
        if (isset($itemsType)) {
            $itemsType->delete();
            return redirect()->route('items.create');
        }
    }
}

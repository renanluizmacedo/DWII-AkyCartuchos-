<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        //   $this->authorizeResource(Address::class, 'address');
    }
    public function index()
    {


        $addresses = Address::all();

        return view('addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addresses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAddressRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        self::validation($request);

        $address = new Address();

        $address->address = mb_strtoupper($request->address, 'UTF-8');
        $address->number = $request->number;
        $address->neighborhood = mb_strtoupper($request->neighborhood, 'UTF-8');
        $address->city = mb_strtoupper($request->city, 'UTF-8');
        $address->zipcode = $request->zipcode;

        $address->save();

        return redirect()->route('addresses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        if (isset($address)) {
            return view('addresses.show', compact('address'));
        }

        return "<h1>Endereço não Encontrado!</h1>";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        if (isset($address)) {
            return view('addresses.edit', compact('address'));
        }

        return "<h1>Endereço não Encontrado!</h1>";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAddressRequest  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        if (isset($address)) {

            $address->address =  mb_strtoupper($request->address, 'UTF-8');
            $address->city =  mb_strtoupper($request->city, 'UTF-8');
            $address->neighborhood =  mb_strtoupper($request->neighborhood, 'UTF-8');
            $address->zipcode = $request->zipcode;
            $address->number = $request->number;

            $address->save();

            return redirect()->route('addresses.index');
        }
        return "<h1>Endereço não Encontrado!</h1>";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        //
    }
    public function validation(Request $request)
    {

        $rules = [
            'address' => 'required|max:100|min:5',
            'number' => 'required|max:20|min:1',
            'neighborhood' => 'required|max:100|min:5',
            'city' => 'required|max:100|min:5',
            'zipcode' => 'required|max:100|min:5',
        ];
        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];

        $request->validate($rules, $msgs);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Stocks;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'barcode' => 'required|unique:items,barcode|min:10|max:10',
            'nama_barang' => 'required',
            'harga' => 'required',
        ]);

        $items = new items($validatedData);

        $items->transaction(function () use ($items) {
            $items->save();

            $stock = new Stocks([
                'items_id' => $items->id,
                'jumlah' => 0,
            ]);

            $stock->save();
        });

        return redirect()->route('stock.index')->with(['success' => 'Data berhasil ditambahkan!']);

        // dd($validatedData);
    }

    /**
     * Display the specified resource.
     */
    public function show(items $items)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(items $items)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, items $items)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(items $items)
    {
        //
    }
}

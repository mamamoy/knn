<?php

namespace App\Http\Controllers;

use App\Models\Stocks;
use App\Models\Items;
use Illuminate\Http\Request;
// use App\Traits\Transactionable;

class StockController extends Controller
{
    // use Transactionable;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $stock = Stocks::with('item')->get();
        $item = Items::with('category')->with('stocks')->get();

        $data = [
            'stock' => $item,
            // 'items' => $item,
        ];

        // dd($data);
        return view('stock.index', $data);
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
            'items_id.*' => 'required',
            'jumlah.*' => 'required|numeric',
        ]);

        $stock = new Stocks();

        $stock->transaction(function () use ($validatedData) {
            foreach ($validatedData['items_id'] as $key => $value) {
                $stockData = Stocks::find($validatedData['items_id'][$key]);
                $stockData->lockForUpdate();
                // dd($stockData);
                $stockData->jumlah += $validatedData['jumlah'][$key];
                $stockData->save();
            }
        });

        return redirect()->route('stock.index')->with(['success' => 'Data berhasil ditambahkan!']);
    }




    /**
     * Store a newly created resource in storage.
     */
    // public function tambahData(Request $request)
    // {
    //     $messages = [
    //         'required' => 'Data :attribute tidak boleh kosong.',
    //         'unique' => 'Data :attribute sudah terdaftar.',
    //         'min' => 'Data :attribute tidak boleh kurang dari :min karakter.',
    //         'max' => 'Data :attribute tidak boleh lebih dari :max.',
    //     ];

    //     $this->validate($request, [
    //         'kode_barang' => 'required|string|unique:stock,kode_barang|min:10|max:10',
    //         'nama_barang' => 'required|string|max:100',
    //     ], $messages);

    //     $datas = stock::create([
    //         'kode_barang' => $request->kode_barang,
    //         'nama_barang' => $request->nama_barang,
    //     ]);

    //     if($datas){

    //         return redirect()->route('stock.index')->with(['success' => 'Data berhasil ditambahkan!']);
    //     }
    //     return redirect()->route('stock.index')->with(['error' => 'Data tidak berhasil ditambahkan!']);
    // }

    /**
     * Display the specified resource.
     */
    public function show(Stocks $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stocks $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stocks $stock)
    {
        // $validatedData = $request->validate([
        //     'kode_barang.*' => 'required',
        //     'jumlah.*' => 'required|numeric',
        // ]);


        // foreach ($validatedData['kode_barang'] as $key => $value) {
        //     $stock = stock::all()->where('id', $request->id);
        //     # code...
        // }
        // $stock->first()->update([
        //     'jumlah' => $request->jumlah,
        // ]);




        // if ($stock) {
        //     //redirect dengan pesan sukses

        //     return redirect()->route('stock.index')->with(['success' => 'Data Berhasil Disimpan!']);
        // } else {
        //     //redirect dengan pesan error
        //     return redirect()->route('stock.index')->with(['error' => 'Data Gagal Disimpan!']);
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stocks $stock)
    {
        //
    }
}

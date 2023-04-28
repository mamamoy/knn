<?php

namespace App\Http\Controllers;

use App\Models\Cashiers;
use App\Models\Customers;
use App\Models\Categories;
use App\Models\Items;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Stocks;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Items::with('category', 'stocks')->get();
        $cashier = Cashiers::all();

        $data = [
            'items' => $items,
            'cashier' => $cashier,
        ];

        return view('order.index', $data);
    }

    public function history()
    {
        $order = Orders::with('cashiers', 'customers')->latest()->get();

        $data = [
            'orders' => $order,
        ];

        // dd($data);
        return view('order.history', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'cashier_id' => 'required',
            'nama_customer' => 'required',
            'email' => 'required',
            'telpon' => 'required',
            'items_id.*' => 'required',
            'jumlah.*' => 'required|numeric',
        ]);

        // dd($validatedData);

        $checkData = Customers::where('email', $validatedData['email'])->first();

        // dd($emailData);
        if ($checkData != null) {
            $orderData = [
                'cashier_id' => $validatedData['cashier_id'],
                'nama_customer' => $checkData->nama_customer,
                'email' => $checkData->email,
                'telpon' => $checkData->telpon
            ];
        } else {
            $orderData = [
                'cashier_id' => $validatedData['cashier_id'],
                'nama_customer' => $validatedData['nama_customer'],
                'email' => $validatedData['email'],
                'telpon' => $validatedData['telpon'],
            ];
        }


        // dd($orderData);

        $orderItems = [];
        foreach ($validatedData['items_id'] as $key => $itemId) {

            // dd($validatedData['jumlah'][$itemId]);
            if ($validatedData['jumlah'][$itemId] > 0) { // perbaikan disini
                $orderItems[] = [
                    'items_id' => $itemId,
                    'jumlah' => $validatedData['jumlah'][$itemId],
                    'harga_total' => $validatedData['jumlah'][$itemId] * Items::findOrFail($itemId)->harga
                ];
            }
        }

        // dd($data);
        return redirect()->route('order.confirm')->with([
            'order_data' => $orderData,
            'order_items' => $orderItems,
        ]);
    }

    public function confirm()
    {

        $orderItems = session('order_items');
        // dd($orderItems);

        $detail = [];
        $total = 0;

        foreach ($orderItems as $key => $value) {
            $filter = Items::where('id', $value['items_id'])->first();
            $subtotal = $filter->harga * $value['jumlah'];
            $total += $subtotal;

            $detail[] = [
                'items_id' => $value['items_id'],
                'nama_barang' => $filter->nama_barang,
                'harga' => $filter->harga,
                'category' => $filter->category->nama_kategori,
                'jumlah' => $value['jumlah'],
                'subtotal' => $subtotal
            ];
        }

        $data = [
            'cashier' => Cashiers::all(),
            'pembeli' => session('order_data'),
            'order_items' => $detail,
            'total' => $total
        ];

        cache()->put('order.confirmation', $data, now()->addMinutes(10));
        // dd($data);

        return view('order.confirmation', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cashier_id' => 'required',
            'nama_customer' => 'required',
            'email' => 'required',
            'telpon' => 'required',
            'items_id.*' => 'required',
            'jumlah.*' => 'required|numeric',
        ]);

        $order = new Orders($validatedData);

        $order->transaction(function () use ($order, $validatedData) {
            $checkData = Customers::where('email', $validatedData['email'])->first();

            if ($checkData != null) {
                $customer_id = $checkData->id;
            } else {
                $customer = new Customers();
                $customer->nama_customer = $validatedData['nama_customer'];
                $customer->email = $validatedData['email'];
                $customer->telpon = $validatedData['telpon'];
                $customer->save();
                $customer_id = $customer->id;
            }

            $order->status = 0;
            $order->cashier_id = $validatedData['cashier_id'];
            $order->customer_id = $customer_id;

            $orderItems = [];

            foreach ($validatedData['items_id'] as $key => $itemId) {
                $item = Items::with('stocks')->findOrFail($itemId);

                if ($item->stocks->jumlah >= $validatedData['jumlah'][$itemId]) {
                    $orderItem = new OrderItems();
                    $orderItem->items_id = $itemId;
                    $orderItem->jumlah = $validatedData['jumlah'][$itemId];
                    $orderItem->harga_total = $validatedData['jumlah'][$itemId] * $item->harga;

                    $orderItems[] = $orderItem;

                    $stock = Stocks::where('items_id', $itemId)->first();
                    $stock->jumlah -= $orderItem->jumlah;
                    $stock->save();
                } else {
                    return redirect()->route('order.index')->with(['error' => 'Stock tidak Mencukupi']);
                }
            }

            if (count($orderItems) === count($validatedData['items_id'])) {
                $order->save();

                foreach ($orderItems as $orderItem) {
                    $orderItem->order_id = $order->id;
                    $orderItem->save();
                }
            }
        });

        if ($order->id) {
            return redirect()->route('order.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('order.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $orderData = Orders::with('customers', 'cashiers')->where('id', $id)->first();
        $orderItems = OrderItems::with('item')->where('order_id', $id)->get();
        $detail = [];
        $total = 0;

        foreach ($orderItems as $key => $value) {
            // dd($value);
            // $filter = Items::where('id', $value['items_id'])->first();
            $subtotal = $value->item->harga * $value->jumlah;
            $total += $subtotal;

            $category = Categories::where('id', $value->item->category_id)->first();

            // dd($namaKategori);

            $detail[] = [
                'nama_barang' => $value->item->nama_barang,
                'harga' => $value->item->harga,
                'category' => $category->nama_kategori,
                'jumlah' => $value->jumlah,
                'subtotal' => $subtotal
            ];
        }


        $data = [
            'order' => $orderData,
            'orderId' => 'TID-' . str_pad($orderData->id, 7, '0', STR_PAD_LEFT),
            'order_items' => $detail,
            'total' => $total,
        ];

        // dd($data);

        return view('order.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Orders::findOrFail($id);
        $order_items = OrderItems::where('order_id', $id);
    }
}

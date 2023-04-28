<?php

namespace App\Http\Controllers;

use App\Models\Cashiers;
use App\Models\Categories;
use App\Models\Customers;
use App\Models\Items;
use Illuminate\Http\Request;
use Phpml\Classification\KNearestNeighbors;
use Phpml\Metric\Accuracy;
use Phpml\Dataset\ArrayDataset;
use Illuminate\Support\Facades\DB;
use Phpml\Metric\ClassificationReport;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Stocks;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cashier = Cashiers::all();
        $items = Items::all();
        $customers = Customers::all();
        $orders = Orders::all();

        $data = [
            'cashier' => $cashier,
            'items' => $items,
            'customers' => $customers,
            'orders' => $orders,
        ];

        return view('dashboard.index', $data);
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
            'k' => 'required|numeric',
            'cashier' => 'required',
        ]);


        // Mendapatkan data dari database
        $orders = Orders::with('orderItems.item')->get();

        // Membuat dataset
        $samples = [];
        $labels = [];
        foreach ($orders as $order) {
            foreach ($order->orderItems as $key => $item) {
                $samples[] = [$item->item->category_id, $order->cashier_id];
                $itemPerKategori = $order->orderItems->where('item.category_id', $item->item->category->id);
                $jumlahPerKategori = $itemPerKategori->sum('jumlah');
                $labels[] = $jumlahPerKategori;
            }
        }

        $dataset = new ArrayDataset($samples, $labels);

        // $k = $request->input('k', 3);

        // Melakukan training dengan KNN
        $classifier = new KNearestNeighbors($validatedData['k']);
        $classifier->train($dataset->getSamples(), $dataset->getTargets());

        // Menghitung total penjualan setiap kategori barang
        $totalSales = [];
        $categories = Categories::all();
        $cashier_id = $validatedData['cashier'];
        foreach ($categories as $category) {
            $samples = [$category->id, $cashier_id];
            $totalSales[$category->nama_kategori] = $classifier->predict([$samples]);
        }

        // dd($totalSales);

        return redirect()->route('dashboard.result')->with([
            'data' => $totalSales,
            'k' => $validatedData['k'],
            'cashier' => $validatedData['cashier'],
        ]);
    }

    public function result(Request $request)
    {
        $totalSales = $request->session()->get('data');
        $k = $request->session()->get('k');
        $cashier = $request->session()->get('cashier');

        $data = [
            'result' => $totalSales,
            'k' => $k,
            'cashier' => Cashiers::where('id', $cashier)->first(),
        ];

        $request->session()->put('result', $data);

        return view('dashboard.result', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }
}

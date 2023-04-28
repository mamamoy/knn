<?php

namespace Database\Seeders;

use App\Models\Items;
use App\Models\OrderItems;
use App\Models\Orders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all orders and items
        $orders = Orders::all();
        $items = Items::all();

        // Generate random order items for each order
        foreach ($orders as $order) {
            $num_items = rand(1, 5); // Random number of items (1-5)
            $order_total = 0;

            // Get random items and add to order
            for ($i = 0; $i < $num_items; $i++) {
                $item = $items->random(); // Get random item
                $quantity = rand(1, 26); // Random quantity (1-10)

                $order_item = new OrderItems();
                $order_item->order_id = $order->id;
                $order_item->items_id = $item->id;
                $order_item->jumlah = $quantity;
                $order_item->harga_total = $item->harga * $quantity;
                $order_item->save();

                $order_total += $order_item->harga_total;
            }
        }
    }
}

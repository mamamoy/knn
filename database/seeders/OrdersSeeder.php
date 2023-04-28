<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Orders;
use Illuminate\Support\Carbon;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Initialize Faker
        $faker = Faker::create('id_ID');

        $startDate = Carbon::now()->subYear(); // set start date to one year ago

        for ($j = 1; $j <= 1000; $j++) {
            $order = new Orders();
            $order->cashier_id = rand(1, 10);
            $order->customer_id = rand(1, 100);
            $order->status = rand(0, 1);

            // generate random date within one year range
            $orderDate = $faker->dateTimeBetween($startDate, 'now');
            $order->created_at = $orderDate;
            $order->updated_at = $orderDate;

            $order->save();
        }
    }
}

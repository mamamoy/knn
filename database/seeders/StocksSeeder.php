<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use App\Models\Stocks;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Initialize Faker
        $faker = Faker::create('id_ID');

        // Generate 100 records
        for ($i = 1; $i <= 100; $i++) {
            $stock = new Stocks();
            $stock->items_id = $i;
            $stock->jumlah = $faker->numberBetween(10, 700);
            $stock->save();
        }
    }
}

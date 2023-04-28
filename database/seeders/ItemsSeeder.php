<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Faker\Generator;
use App\Models\Items;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemsSeeder extends Seeder
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
            $stock = new Items();
            $stock->category_id = rand(1, 10);
            $stock->barcode = $faker->unique()->isbn10();
            $stock->nama_barang = $faker->sentence(2);
            $stock->harga = $faker->randomFloat(0, 5000, 600000);
            $stock->save();
        }
    }
}

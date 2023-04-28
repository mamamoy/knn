<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use App\Models\Cashiers;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CashiersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Initialize Faker
        $faker = Faker::create('id_ID');

        // Generate 10 records
        for ($i = 1; $i <= 10; $i++) {
            $cashier = new Cashiers();
            $cashier->nama_kasir = $faker->name();
            $cashier->save();
        }
    }
}

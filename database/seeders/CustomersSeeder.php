<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use App\Models\Customers;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomersSeeder extends Seeder
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
            $customers = new Customers();
            $customers->nama_customer = $faker->name();
            $customers->email = $faker->email();
            $customers->telpon = $faker->phoneNumber();
            $customers->save();
        }
    }
}

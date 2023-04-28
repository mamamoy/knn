<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categories;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category_name = ['Foods', 'Beverages', 'Electronics', 'Clothing', 'Home and Garden', 'Books', 'Sports and Outdoors', 'Toys and Games', 'Health and Beauty', 'Automotive'];

        
        foreach ($category_name as $name) {
            $category = new Categories();
            $category->nama_kategori = $name;
            $category->save();
        }
    }
}

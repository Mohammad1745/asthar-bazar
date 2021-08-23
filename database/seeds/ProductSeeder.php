<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'category_id' => 1,
            'title' => 'ঘি',
        ]);
        Product::create([
            'category_id' => 1,
            'title' => 'মাখন',
        ]);
        Product::create([
            'category_id' => 2,
            'title' => 'পেয়াজ',
        ]);
        Product::create([
            'category_id' => 2,
            'title' => 'রসুন',
        ]);
        Product::create([
            'category_id' => 3,
            'title' => 'তেলাপিয়া',
        ]);
        Product::create([
            'category_id' => 3,
            'title' => 'বেলে',
        ]);
        Product::create([
            'category_id' => 4,
            'title' => 'বাগদা',
        ]);
        Product::create([
            'category_id' => 4,
            'title' => 'গলদা',
        ]);
    }
}

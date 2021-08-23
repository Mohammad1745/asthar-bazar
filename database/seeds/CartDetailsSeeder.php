<?php

use App\Models\CartDetails;
use Illuminate\Database\Seeder;

class CartDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CartDetails::create([
            'cart_id' => 1,
            'product_id' => 8,
            'product_variation_id' => 12,
            'quantity' => 2,
            'price' => 99.98
        ]);
        CartDetails::create([
            'cart_id' => 1,
            'product_id' => 7,
            'product_variation_id' => 10,
            'quantity' => 1,
            'price' => 49.99
        ]);
        CartDetails::create([
            'cart_id' => 1,
            'product_id' => 3,
            'product_variation_id' => 4,
            'quantity' => 2,
            'price' => 79.98
        ]);
    }
}

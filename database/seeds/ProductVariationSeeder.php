<?php

use App\Models\ProductVariation;
use Illuminate\Database\Seeder;

class ProductVariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductVariation::create([
            'product_id' => 1,
            'type_id' => 1,
            'title' => '৫০০গ্রাম',
            'description' => 'Pure Ghee.',
            'image' => '5ef87d681f407.png',
            'quantity' => 5,
            'unit_of_quantity' => 'pc',
            'weight_per_unit' => 0.5,
            'manufacturing_cost' => 38.99,
            'regular_price' => 50,
            'unit_price' => 39.99,
            'status' => true,
            'available_at' => '2020-05-01',
        ]);
        ProductVariation::create([
            'product_id' => 2,
            'type_id' => 1,
            'title' => '২০০গ্রাম',
            'description' => 'Pure Makhon.',
            'image' => '5ef87d681f407.png',
            'quantity' => 5,
            'unit_of_quantity' => 'pc',
            'weight_per_unit' => 0.2,
            'manufacturing_cost' => 48.99,
            'regular_price' => 50,
            'unit_price' => 49.99,
            'status' => true,
            'available_at' => '2020-05-01',
        ]);
        ProductVariation::create([
            'product_id' => 3,
            'type_id' => 2,
            'title' => 'দেশি',
            'description' => 'High Quality.',
            'image' => '5ef87d681f407.png',
            'quantity' => 5,
            'unit_of_quantity' => 'kg',
            'weight_per_unit' => 1,
            'manufacturing_cost' => 48.99,
            'regular_price' => 50,
            'unit_price' => 49.99,
            'status' => true,
            'available_at' => '2020-05-01',
        ]);
        ProductVariation::create([
            'product_id' => 3,
            'type_id' => 2,
            'title' => 'ভারতীয়',
            'description' => 'Mid Quality.',
            'image' => '5ef87d681f407.png',
            'quantity' => 5,
            'unit_of_quantity' => 'kg',
            'weight_per_unit' => 1,
            'manufacturing_cost' => 39,
            'regular_price' => 50,
            'unit_price' => 39.99,
            'status' => true,
            'available_at' => '2020-05-01',
        ]);
        ProductVariation::create([
            'product_id' => 4,
            'type_id' => 2,
            'title' => 'গোটা',
            'description' => 'Good Quality.',
            'image' => '5ef87d681f407.png',
            'quantity' => 5,
            'unit_of_quantity' => 'kg',
            'weight_per_unit' => 1,
            'manufacturing_cost' => 88,
            'regular_price' => 90,
            'unit_price' => 89.99,
            'status' => true,
            'available_at' => '2020-05-01',
        ]);
        ////////
        ProductVariation::create([
            'product_id' => 5,
            'type_id' => 3,
            'title' => 'ছোট সাইজ',
            'description' => '5-7 per kg',
            'image' => '5ef87d681f407.png',
            'quantity' => 5,
            'unit_of_quantity' => 'kg',
            'weight_per_unit' => 1,
            'manufacturing_cost' => 38,
            'regular_price' => 50,
            'unit_price' => 39.99,
            'status' => true,
            'available_at' => '2020-05-01',
        ]);
        ProductVariation::create([
            'product_id' => 5,
            'type_id' => 4,
            'title' => 'বড় সাইজ',
            'description' => '3-4 per kg',
            'image' => '5ef87d681f407.png',
            'quantity' => 5,
            'unit_of_quantity' => 'kg',
            'weight_per_unit' => 1,
            'manufacturing_cost' => 40,
            'regular_price' => 50,
            'unit_price' => 44.99,
            'status' => true,
            'available_at' => '2020-05-01',
        ]);
        ProductVariation::create([
            'product_id' => 6,
            'type_id' => 3,
            'title' => 'ছোট সাইজ',
            'description' => '6-8 per kg',
            'image' => '5ef87d681f407.png',
            'quantity' => 5,
            'unit_of_quantity' => 'kg',
            'weight_per_unit' => 1,
            'manufacturing_cost' => 47,
            'regular_price' => 50,
            'unit_price' => 49.99,
            'status' => true,
            'available_at' => '2020-05-01',
        ]);
        ProductVariation::create([
            'product_id' => 6,
            'type_id' => 4,
            'title' => 'বড় সাইজ',
            'description' => '5-6 per kg',
            'image' => '5ef87d681f407.png',
            'quantity' => 5,
            'unit_of_quantity' => 'kg',
            'weight_per_unit' => 1,
            'manufacturing_cost' => 54,
            'regular_price' => 58,
            'unit_price' => 55.99,
            'status' => true,
            'available_at' => '2020-05-01',
        ]);
        ProductVariation::create([
            'product_id' => 7,
            'type_id' => 3,
            'title' => 'ছোট সাইজ',
            'description' => '7-8 per kg',
            'image' => '5ef87d681f407.png',
            'quantity' => 5,
            'unit_of_quantity' => 'kg',
            'weight_per_unit' => 1,
            'manufacturing_cost' => 48,
            'regular_price' => 50,
            'unit_price' => 49.99,
            'status' => true,
            'available_at' => '2020-05-01',
        ]);
        ProductVariation::create([
            'product_id' => 7,
            'type_id' => 4,
            'title' => 'বড় সাইজ',
            'description' => '5-6 per kg',
            'image' => '5ef87d681f407.png',
            'quantity' => 5,
            'unit_of_quantity' => 'kg',
            'weight_per_unit' => 1,
            'manufacturing_cost' => 48,
            'regular_price' => 50,
            'unit_price' => 49.99,
            'status' => true,
            'available_at' => '2020-05-01',
        ]);
        ProductVariation::create([
            'product_id' => 8,
            'type_id' => 3,
            'title' => 'ছোট সাইজ',
            'description' => '10-12 per kg',
            'image' => '5ef87d681f407.png',
            'quantity' => 5,
            'unit_of_quantity' => 'kg',
            'weight_per_unit' => 1,
            'manufacturing_cost' => 48,
            'regular_price' => 50,
            'unit_price' => 49.99,
            'status' => true,
            'available_at' => '2020-05-01',
        ]);
        ProductVariation::create([
            'product_id' => 8,
            'type_id' => 4,
            'title' => 'বড় সাইজ',
            'description' => '7-8 per kg',
            'image' => '5ef87d681f407.png',
            'quantity' => 5,
            'unit_of_quantity' => 'kg',
            'weight_per_unit' => 1,
            'manufacturing_cost' => 48,
            'regular_price' => 50,
            'unit_price' => 49.99,
            'status' => true,
            'available_at' => '2020-05-01',
        ]);
    }
}

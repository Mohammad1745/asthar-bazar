<?php

use App\Models\ShippingMethod;
use Illuminate\Database\Seeder;

class ShippingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShippingMethod::create([
            'title' => 'Express Shipping',
            'logo' => null,
            'extra_charge' => 'add,100tk',
            'description' => 'Typically, it takes 24 hours.',
            'status' => true,
        ]);
    }
}

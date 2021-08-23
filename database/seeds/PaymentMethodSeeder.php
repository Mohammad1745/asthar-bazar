<?php

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::create([
            'title' => 'bKash',
            'logo' => null,
            'extra_charge' => 'mul,0.15',
            'description' => 'Select \'Send Money\' Option. Pay with checkout cost(1.5%)',
            'status' => true,
        ]);
        PaymentMethod::create([
            'title' => 'Cash on delivery',
            'logo' => null,
            'extra_charge' => 'add,40',
            'description' => 'Get product, handover money. Pay 40tk as \'Cash on delivery\' charge.',
            'status' => true,
        ]);
    }
}

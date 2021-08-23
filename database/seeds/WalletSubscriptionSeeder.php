<?php

use App\Models\WalletSubscription;
use Illuminate\Database\Seeder;

class WalletSubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WalletSubscription::create(['package' => 'Bronze', 'charge' => 0, 'capacity' => 100]);
        WalletSubscription::create(['package' => 'Silver', 'charge' => 25, 'capacity' => 250]);
        WalletSubscription::create(['package' => 'Golden', 'charge' => 50, 'capacity' => 500]);
        WalletSubscription::create(['package' => 'Titanium', 'charge' => 100, 'capacity' => 1000]);
        WalletSubscription::create(['package' => 'Platinum', 'charge' => 250, 'capacity' => 2500]);
        WalletSubscription::create(['package' => 'Zirconium', 'charge' => 500, 'capacity' => 5000]);
        WalletSubscription::create(['package' => 'Uranium', 'charge' => 1000, 'capacity' => 10000]);
    }
}

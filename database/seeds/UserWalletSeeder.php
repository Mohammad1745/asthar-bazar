<?php

use App\Models\UserWallet;
use Illuminate\Database\Seeder;

class UserWalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserWallet::create([
            'user_id' => 4,
            'wallet_subscription_id' => 1,
            'amount' => 0,
            'capacity' => 100,
            'expires_at' => "2021-05-05",
        ]);
    }
}

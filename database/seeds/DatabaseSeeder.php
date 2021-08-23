<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(WalletSubscriptionSeeder::class);
        $this->call(UserWalletSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(ShippingMethodSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(DepartmentOwnershipSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductVariationSeeder::class);
        $this->call(CollectionSeeder::class);
        $this->call(CartSeeder::class);
        $this->call(CartDetailsSeeder::class);
    }
}

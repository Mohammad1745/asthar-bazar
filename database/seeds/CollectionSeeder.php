<?php

use App\Models\Collection;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Collection::create([
            'title' => 'new',
            'department_id' => 1,
            'discount' => 5,
            'expires_at' => '2020-09-01',
        ]);
        Collection::create([
            'title' => 'new',
            'department_id' => 2,
            'discount' => 5,
            'expires_at' => '2020-09-01',
        ]);
    }
}

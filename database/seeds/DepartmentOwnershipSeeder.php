<?php

use App\Models\DepartmentOwnership;
use Illuminate\Database\Seeder;

class DepartmentOwnershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DepartmentOwnership::create([
            'user_id' => 2,
            'department_id' => '1',
            'status' => DEPARTMENT_ACTIVE_STATUS,
        ]);
        DepartmentOwnership::create([
            'user_id' => 3,
            'department_id' => '2',
            'status' => DEPARTMENT_ACTIVE_STATUS,
        ]);
    }
}

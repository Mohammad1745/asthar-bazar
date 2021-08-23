<?php

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'title' => 'Groceries',
            'cover_photo' => 'null',
            'description' => 'Grocery Items',
        ]);
        Department::create([
            'title' => 'Fish & Shrimp',
            'cover_photo' => 'null',
            'description' => 'Fish & Shrimp',
        ]);
    }
}

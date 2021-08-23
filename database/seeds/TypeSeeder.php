<?php

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::create([
            'title' => 'প্যাকেটজাত',
            'department_id' => 1,
            'description' => 'প্যাকেটজাত ।',

        ]);
        Type::create([
            'title' => 'খোলা',
            'department_id' => 1,
            'description' => 'খোলা ।',
        ]);
        Type::create([
            'title' => 'তাজা',
            'department_id' => 2,
            'description' => 'জীবিত মাছ এবং চিংড়ি।',

        ]);
        Type::create([
            'title' => 'হিমায়িত',
            'department_id' => 2,
            'description' => 'হিমায়িত মাছ এবং চিংড়ি।',
        ]);
    }
}

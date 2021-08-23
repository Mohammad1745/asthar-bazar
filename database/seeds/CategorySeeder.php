<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'title' => 'দুগ্ধজাত',
            'department_id' => 1,
            'parent_id' => null,
            'description' => 'দুগ্ধজাতীয় ।',
        ]);
        Category::create([
            'title' => 'মসলা',
            'department_id' => 1,
            'parent_id' => null,
            'description' => 'মসলা ।',
        ]);
        Category::create([
            'title' => 'মাছ',
            'department_id' => 2,
            'parent_id' => null,
            'description' => 'মাছ ।',
        ]);
        Category::create([
            'title' => 'চিংড়ি',
            'department_id' => 2,
            'parent_id' => null,
            'description' => 'চিংড়ি।',
        ]);
    }
}

<?php

namespace Database\Seeders;

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
        Category::insert([
            ['category_name' => 'PHP'],
            ['category_name' => 'Java'],
            ['category_name' => 'Javascript'],
            ['category_name' => 'Python'],
            ['category_name' => 'C++'],
            ['category_name' => 'C#'],
            ['category_name' => 'Ruby'],
            ['category_name' => 'Go'],
            ['category_name' => 'Frameworks'],
        ]);
    }
}

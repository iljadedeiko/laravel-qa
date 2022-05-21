<?php

namespace Database\Seeders;

use App\Models\ProgLanguages;
use Illuminate\Database\Seeder;

class ProgLanguagesSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProgLanguages::insert([
            ['prog_language' => 'PHP'],
            ['prog_language' => 'Java'],
            ['prog_language' => 'GO'],
            ['prog_language' => 'Ruby'],
        ]);
    }
}

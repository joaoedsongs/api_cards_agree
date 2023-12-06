<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Expansion;

class ExpansionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $expansionNames = ['Base Set', 'Jungle', 'Fossil', 'Base Set 2'];

            foreach ($expansionNames as $name) {
                Expansion::firstOrCreate(['name' => $name]);
            }
    }
}

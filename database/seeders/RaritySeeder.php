<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rarity;

class RaritySeeder extends Seeder{

    /**
     * Run the database seeds.
     */
    public function run(): void{

        $rarityNames = ['Común', 'No Común', 'Rara'];

        foreach ($rarityNames as $name) {
            Rarity::firstOrCreate(['name' => $name]);
        }
    }
}

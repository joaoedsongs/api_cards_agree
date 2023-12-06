<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $typeNames = [
            'Agua', 'Fuego', 'Hierba', 'Eléctrico', 'Hielo', 'Lucha', 'Veneno', 'Tierra', 'Volador',
            'Psíquico', 'Bicho', 'Roca', 'Fantasma', 'Dragón', 'Siniestro', 'Acero', 'Hada'
        ];


        foreach ($typeNames as $name) {
            Type::firstOrCreate(['name' => $name]);
        }
    }
}

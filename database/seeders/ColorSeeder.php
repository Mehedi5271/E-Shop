<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            [
                'id'=> 1,
                'name'=> 'red'
            ],
            [
                'id'=> 2,
                'name'=> 'black'
            ],
            [
                'id'=> 3,
                'name'=> 'pink'
            ]
            ];

            foreach($colors as $color){
                Color::create($color);
            }
    }
}

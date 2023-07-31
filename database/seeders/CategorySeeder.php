<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Nette\Utils\Random;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        Category::create([
//            'name' => "phones",
//        ]);
//        Category::create([
//            'name' => "laptops",
//        ]);
        Color::create([
            'name'=>'blue',
            'hex'=>'#0000ff'
        ]);
        Color::create([
            'name'=>'red',
            'hex'=>'#ff0000'
        ]);
        Color::create([
            'name'=>'green',
            'hex'=>'#00ff00'
        ]);
        Color::create([
            'name'=>'yellow',
            'hex'=>'#ffff00'
        ]);
    }
}

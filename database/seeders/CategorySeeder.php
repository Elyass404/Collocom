<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //we can use this method to insert the data or the method below 
        // Category::insert([
        //         ['name' => 'House'],
        //         ['name' => 'Room'],
        //         ['name' => 'Appartment'],
        //         ["name"=>"Studio"],
        // ]);

        DB::table("categories")->insert([
            ["name"=>"House"], 
            ["name"=>"Room"],
            ["name" => "Appartment"],
            ["name" => "Studio"]
        ]);
    }
}

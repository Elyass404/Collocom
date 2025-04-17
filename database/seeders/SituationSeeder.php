<?php

namespace Database\Seeders;

use App\Models\Situations;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SituationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Situations::factory()->count(10)->create();
    }
}

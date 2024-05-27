<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Year;

class YearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // for ($i = 1; $i <= 5; $i++) {
        //     year::create([
        //         'year' => '202' . $i,
        //         'slug' => '202' . $i,
        //     ]);
        // }
        Year::factory()->count(5)->create();
    }
}

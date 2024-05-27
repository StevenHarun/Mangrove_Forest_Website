<?php

namespace Database\Seeders;

use App\Models\Spot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SpotYear;
use App\Models\Year;

class SpotYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // for ($i = 1; $i <= 5; $i++) {
        //     SpotYear::create([
        //         'year_id' => $i,
        //         'spot_id' => $i,
        //     ]);
        // }
        // SpotYear::create([
        //     'year_id' => 1,
        //     'spot_id' => 1,
        // ]);

        $years = Year::all();
        $spots = Spot::all();

        foreach ($years as $year) {
            foreach ($spots as $spot) {
                SpotYear::create([
                    'year_id' => $year->id,
                    'spot_id' => $spot->id,
                ]);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\reports;
use Carbon\Carbon;



class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // start date (1-1-2024)
        $startDate = Carbon::create(2024, 1, 1);
        // looping 50 dummy data
        for ($i = 1; $i <= 50; $i++) {
            reports::create([
                'report_title' => 'Kerusakan ' . $i,
                'category' => 'Kerusakan',
                'coordinates' => json_encode([
                    "type" => "FeatureCollection",
                    "features" => [
                        [
                            "type" => "Feature",
                            "properties" => ["report_title" => 'Kerusakan ' . $i],
                            "geometry" => [
                                "type" => "Point",
                                "coordinates" => [110.738277 + rand(-1000, 1000) / 10000, -7.85032 + rand(-1000, 1000) / 10000]
                            ]
                        ]
                    ]
                ]),
                'fillColor' => '#E78413',
                'date' => $startDate->copy()->addDays(rand(0, 120))->format('Y-m-d'),
                'description' => 'Kerusakan yang terjadi di lokasi ' . $i
            ]);
        }

        // start date (1-1-2024)
        $startDate = Carbon::create(2024, 1, 1);
        for ($i = 1; $i <= 50; $i++) {
        // looping 50 dummy data
            reports::create([
                'report_title' => 'Penghijauan ' . $i,
                'category' => 'Penghijauan',
                'coordinates' => json_encode([
                    "type" => "FeatureCollection",
                    "features" => [
                        [
                            "type" => "Feature",
                            "properties" => ["report_title" => 'Penghijauan ' . $i],
                            "geometry" => [
                                "type" => "Point",
                                "coordinates" => [107.738277 + rand(-1000, 1000) / 10000, -6.85032 + rand(-1000, 1000) / 10000]
                            ]
                        ]
                    ]
                ]),
                'fillColor' => '#11D44C',
                'date' => $startDate->copy()->addDays(rand(0, 120))->format('Y-m-d'),
                'description' => 'Penghijauan yang dilakukan di lokasi ' . $i
            ]);
        }
    }
}

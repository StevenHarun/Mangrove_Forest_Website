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
        function getRandomDate($startDate, $endDate) {
            return $startDate->copy()->addDays(rand(0, $startDate->diffInDays($endDate)))->format('Y-m-d');
        }
        
        // Gap date
        $startDate = Carbon::create(2019, 1, 1);
        $endDate = Carbon::create(2024, 6, 6);
        
        // Seeder for "Kerusakan"
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
                'date' => getRandomDate($startDate, $endDate),
                'description' => 'Kerusakan yang terjadi di lokasi ' . $i
            ]);
        }
        
        // Seeder for "Penghijauan"
        for ($i = 1; $i <= 50; $i++) {
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
                'date' => getRandomDate($startDate, $endDate),
                'description' => 'Penghijauan yang dilakukan di lokasi ' . $i
            ]);
        }
    }
}

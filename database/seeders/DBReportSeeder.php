<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DBReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reports = [];
        
        for ($i = 1; $i <= 30; $i++) { // Mengubah batasan loop menjadi 30
            // Determine category and fillColor
            $category = $i % 2 == 0 ? 'Kerusakan' : 'Penghijauan';
            $fillColor = $category == 'Kerusakan' ? '#E78413' : '#11D44C';

            // Generate report title and description
            $report_title = $category . ' Laporan ' . $i;
            $description = $category == 'Kerusakan' 
                ? 'Deskripsi kerusakan ' . $i 
                : 'Deskripsi penghijauan ' . $i;

            // Generate random coordinates within a specific range
            $longitude = 110 + (rand(0, 99) / 100); // Random value between 110 and 111
            $latitude = -5 + (rand(0, 99) / 100); // Random value between -5 and -4
            $coordinates = '{"type":"FeatureCollection","features":[{"type":"Feature","properties":{"report_title":"' . $report_title . '"},"geometry":{"type":"Point","coordinates":[' . $longitude . ', ' . $latitude . ']}}]}';

            // Create dummy report data
            $reports[] = [
                'report_title' => $report_title,
                'category' => $category,
                'coordinates' => $coordinates,
                'fillColor' => $fillColor,
                'date' => Carbon::now()->subDays($i), // Substract $i days from current date
                'description' => $description,
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert the dummy data into the reports table
        DB::table('reports')->insert($reports);
    }
}

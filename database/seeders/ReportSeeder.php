<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\reports;


class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        reports::create([
            'report_title' => 'Kebakaran hutan',
            'category' => 'Kerusakan',
            'coordinates' => '{"type":"FeatureCollection","features":[{"type":"Feature","properties":{"report_title":"Kebakaran hutan"},"geometry":{"type":"Point","coordinates":[110.738277,-7.85032]}}]}',
            'fillColor' => '#E78413',
            'date' => '2024-05-13',
            'description' => 'Kebarakan karena membakar hutan' 
        ]);
    }
}

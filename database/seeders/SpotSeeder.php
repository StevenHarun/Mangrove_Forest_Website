<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Spot;

class SpotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //{"type":"FeatureCollection","features":[{"type":"Feature","properties":{"name":"Hutan Mangrove"},"geometry":{"type":"Polygon","coordinates":[[[108.65506,-7.703167],[108.647507,-7.711332],[108.652657,-7.717286],[108.655746,-7.721368],[108.661549,-7.722814],[108.664896,-7.726089],[108.669102,-7.727619],[108.670432,-7.730086],[108.673522,-7.725706],[108.675754,-7.722134],[108.677985,-7.722049],[108.676311,-7.718434],[108.672363,-7.713884],[108.670303,-7.71197],[108.665926,-7.707802],[108.660819,-7.705293],[108.658115,-7.702656],[108.65506,-7.703167]]]}}]}

        // function getRandomCoordinate($lat, $lng) {
        //     return [
        //         $lng + rand(-1000, 1000) / 10000,
        //         $lat + rand(-1000, 1000) / 10000
        //     ];
        // }
        
        // $baseCoordinates = [
        //     [108.65506, -7.703167],
        //     [108.647507, -7.711332],
        //     [108.652657, -7.717286],
        //     [108.655746, -7.721368],
        //     [108.661549, -7.722814],
        //     [108.664896, -7.726089],
        //     [108.669102, -7.727619],
        //     [108.670432, -7.730086],
        //     [108.673522, -7.725706],
        //     [108.675754, -7.722134],
        //     [108.677985, -7.722049],
        //     [108.676311, -7.718434],
        //     [108.672363, -7.713884],
        //     [108.670303, -7.71197],
        //     [108.665926, -7.707802],
        //     [108.660819, -7.705293],
        //     [108.658115, -7.702656],
        //     [108.65506, -7.703167]
        // ];
        
        // for ($i = 1; $i <= 5; $i++) {
        //     $randomizedCoordinates = array_map(function($coordinate) {
        //         return getRandomCoordinate($coordinate[1], $coordinate[0]);
        //     }, $baseCoordinates);
        
        //     Spot::create([
        //         'name' => 'Hutan Mangruv ' . $i,
        //         'slug' => 'Hutan-Mangruv' . $i,
        //         'description' => 'Hutan Mangruv di lokasi ' . $i,
        //         'coordinates' => json_encode([
        //             "type" => "FeatureCollection",
        //             "features" => [
        //                 [
        //                     "type" => "Feature",
        //                     "properties" => ["name" => "Hutan Mangrove"],
        //                     "geometry" => [
        //                         "type" => "Polygon",
        //                         "coordinates" => [$randomizedCoordinates]
        //                     ]
        //                 ]
        //             ]
        //         ]),
        //         'fillColor' => '#65B741',
        //     ]);
        // }

        // Spot::create([
        //     'name' => 'Hutan Manguv',
        //     'slug' => 'admin@example.com',
        //     'description' => 'Hutan Mangruv 1',
        //     'coordinates' => '{"type":"FeatureCollection","features":[{"type":"Feature","properties":{"name":"Hutan Mangrove"},"geometry":{"type":"Polygon","coordinates":[[[108.65506,-7.703167],[108.647507,-7.711332],[108.652657,-7.717286],[108.655746,-7.721368],[108.661549,-7.722814],[108.664896,-7.726089],[108.669102,-7.727619],[108.670432,-7.730086],[108.673522,-7.725706],[108.675754,-7.722134],[108.677985,-7.722049],[108.676311,-7.718434],[108.672363,-7.713884],[108.670303,-7.71197],[108.665926,-7.707802],[108.660819,-7.705293],[108.658115,-7.702656],[108.65506,-7.703167]]]}}]}',
        //     'fillColor' => '#65B741',
        // ]);

        Spot::factory()->count(5)->create();
    }
}

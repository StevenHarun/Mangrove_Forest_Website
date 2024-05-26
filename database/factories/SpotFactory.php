<?php

namespace Database\Factories;

use App\Models\Spot;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Spot>
 */
class SpotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Spot::class;
    public function definition(): array
    {
        // function randomCoordinates($lat, $lng) {
        //     return [
        //         $lng + rand(-1000, 1000) / 10000,
        //         $lat + rand(-1000, 1000) / 10000
        //     ];
        // }


        $baseCoordinates = [
            [108.65506, -7.703167],
            [108.647507, -7.711332],
            [108.652657, -7.717286],
            [108.655746, -7.721368],
            [108.661549, -7.722814],
            [108.664896, -7.726089],
            [108.669102, -7.727619],
            [108.670432, -7.730086],
            [108.673522, -7.725706],
            [108.675754, -7.722134],
            [108.677985, -7.722049],
            [108.676311, -7.718434],
            [108.672363, -7.713884],
            [108.670303, -7.71197],
            [108.665926, -7.707802],
            [108.660819, -7.705293],
            [108.658115, -7.702656],
            [108.65506, -7.703167]
        ];

        // $randomizedCoordinates = array_map(function($coordinate) {
        //         return randomCoordinates($coordinate[1], $coordinate[0]);
        //     }, $baseCoordinates);

        $coordinates = [
            "type" => "FeatureCollection",
            "features" => [
                [
                    "type" => "Feature",
                    "properties" => ["name" => "Hutan Mangrove"],
                    "geometry" => [
                        "type" => "Polygon",
                        // "coordinates" => [$randomizedCoordinates]
                        "coordinates" => [
                            [
                                [108.65506, -7.703167],
                                [108.647507, -7.711332],
                                [108.652657, -7.717286],
                                [108.655746, -7.721368],
                                [108.661549, -7.722814],
                                [108.664896, -7.726089],
                                [108.669102, -7.727619],
                                [108.670432, -7.730086],
                                [108.673522, -7.725706],
                                [108.675754, -7.722134],
                                [108.677985, -7.722049],
                                [108.676311, -7.718434],
                                [108.672363, -7.713884],
                                [108.670303, -7.71197],
                                [108.665926, -7.707802],
                                [108.660819, -7.705293],
                                [108.658115, -7.702656],
                                [108.65506, -7.703167]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        return [
            'name' => $this->faker->word,
            'slug' => $this->faker->slug,
            'description' => $this->faker->paragraph,
            'coordinates' => json_encode($coordinates),
            'fillColor' => '#65B741',
        ];
    }
}

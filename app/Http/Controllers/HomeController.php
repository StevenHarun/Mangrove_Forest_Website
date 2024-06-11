<?php

namespace App\Http\Controllers;

use App\Models\Spot;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Year;
use App\Models\Reports;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Geotools\Geotools;
use League\Geotools\Polygon\Polygon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private function calculatePolygonArea($coordinates)
    {
        $earthRadius = 6371000; // Radius of the Earth in meters
        $area = 0;
        $numPoints = count($coordinates);
        
        for ($i = 0; $i < $numPoints; $i++) {
            $j = ($i + 1) % $numPoints;
            $xi = deg2rad($coordinates[$i][0]);
            $yi = deg2rad($coordinates[$i][1]);
            $xj = deg2rad($coordinates[$j][0]);
            $yj = deg2rad($coordinates[$j][1]);
            
            $area += ($xj - $xi) * (2 + sin($yi) + sin($yj));
        }
        
        $area = $area * $earthRadius * $earthRadius / 2.0;
        return abs($area);
    }

    public function index()
    {
        if(Auth::id())
        {
            $role=Auth()->user()->role;

            if($role=='User')
            {
                // Ambil data tahun dari database
                $years = Year::all()->pluck('year')->toArray();

                $labelSpots = array_map(function($year) {
                    return "$year";
                }, $years);

                // Data GeoJSON untuk chart spot
                $geojsons = Spot::all()->pluck('coordinates');
                
                // Array untuk menyimpan hasil luas masing-masing GeoJSON
                $areas = [];

                // Mendekode data GeoJSON dan menghitung luas masing-masing
                foreach ($geojsons as $index => $geojson) {
                    $data = json_decode($geojson, true);
                    $totalAreaInSquareMeters = 0;

                    foreach ($data['features'] as $feature) {
                        if (isset($feature['geometry']['coordinates'][0])) {
                            $coordinates = $feature['geometry']['coordinates'][0];
                            $totalAreaInSquareMeters += $this->calculatePolygonArea($coordinates);
                        }
                    }

                    $totalAreaInSquareKilometers = $totalAreaInSquareMeters / 1e6; // Konversi ke kilometer persegi

                    // Menyimpan hasil luas untuk GeoJSON ini
                    $areas[] = [
                        'geojsonIndex' => $index,
                        'areaInSquareMeters' => $totalAreaInSquareMeters,
                        'areaInSquareKilometers' => $totalAreaInSquareKilometers
                    ];
                }

                // Hanya mengakses value dari areaInSquareKilometers
                $areaInSquareKilometers = array_map(function ($area) {
                    return $area['areaInSquareKilometers'];
                }, $areas); 

                $chartSpots = app()
                    ->chartjs->name("SpotsChart")
                    ->type("bar")
                    ->size(["width" => 400, "height" => 200])
                    ->labels($labelSpots)
                    ->datasets([
                        [
                            "label" => "Spots area in Kilometer",
                            "backgroundColor" => "rgba(75, 192, 192, 0.2)",
                            "borderColor" => "rgba(75, 192, 192, 1)",
                            "data" => $areaInSquareKilometers
                        ]
                    ])
                    ->options([
                        'plugins' => [
                            'title' => [
                                'display' => true,
                                'text' => 'Yearly Spots Area'
                            ]
                        ]
                    ]);

                // chart report
                $start = Carbon::parse(Reports::min("date"));
                $end = Carbon::now();
                $period = CarbonPeriod::create($start, "1 year", $end);
                
                $reportsPerYear = collect($period)->map(function ($date) {
                    $endDate = $date->copy()->endOfYear();
                    $countPenghijauan = Reports::where("date", "<=", $endDate)
                                                ->where("category", "penghijauan")
                                                ->count();
                    $countKerusakan = Reports::where("date", "<=", $endDate)
                                                ->where("category", "kerusakan")
                                                ->count();
                
                    return [
                        "penghijauan" => $countPenghijauan,
                        "kerusakan" => $countKerusakan,
                        "year" => $endDate->format("Y")
                    ];
                });
                
                $dataPenghijauan = $reportsPerYear->pluck("penghijauan")->toArray();
                $dataKerusakan = $reportsPerYear->pluck("kerusakan")->toArray();
                $labels = $reportsPerYear->pluck("year")->toArray();
                
                $chartPenghijauan = app()
                    ->chartjs->name("PenghijauanChart")
                    ->type("line")
                    ->size(["width" => 400, "height" => 200])
                    ->labels($labels)
                    ->datasets([
                        [
                            "label" => "Penghijauan",
                            "backgroundColor" => "rgba(75, 192, 192, 0.2)",
                            "borderColor" => "rgba(75, 192, 192, 1)",
                            "data" => $dataPenghijauan
                        ]
                    ])
                    ->options([
                        'scales' => [
                            'x' => [
                                'type' => 'time',
                                'time' => [
                                    'unit' => 'year'
                                ],
                                'min' => $start->format("Y-m-d"),
                            ]
                        ],
                        'plugins' => [
                            'title' => [
                                'display' => true,
                                'text' => 'Yearly Reports for Penghijauan Category'
                            ]
                        ]
                    ]);
                
                $chartKerusakan = app()
                    ->chartjs->name("KerusakanChart")
                    ->type("bar")
                    ->size(["width" => 400, "height" => 200])
                    ->labels($labels)
                    ->datasets([
                        [
                            "label" => "Kerusakan",
                            "backgroundColor" => "rgba(255, 99, 132, 0.2)",
                            "borderColor" => "rgba(255, 99, 132, 1)",
                            "data" => $dataKerusakan
                        ]
                    ])
                    ->options([
                        'scales' => [
                            'x' => [
                                'type' => 'time',
                                'time' => [
                                    'unit' => 'year'
                                ],
                                'min' => $start->format("Y-m-d"),
                            ]
                        ],
                        'plugins' => [
                            'title' => [
                                'display' => true,
                                'text' => 'Yearly Reports for Kerusakan Category'
                            ]
                        ]
                    ]);
                
                    return view('user.user-dashboard', compact(["chartPenghijauan", "chartKerusakan", "chartSpots"]), [
                        'kilo' => array_sum($areaInSquareKilometers) 
                    ]);
            }
            else if($role=='Admin')
            {
                return view('admin.admin-dashboard');
            }   
            else if($role=='Pemda')
            {
                // Ambil data tahun dari database
                $years = Year::all()->pluck('year')->toArray();

                $labelSpots = array_map(function($year) {
                    return "$year";
                }, $years);

                // Data GeoJSON untuk chart spot
                $geojsons = Spot::all()->pluck('coordinates');
                
                // Array untuk menyimpan hasil luas masing-masing GeoJSON
                $areas = [];

                // Mendekode data GeoJSON dan menghitung luas masing-masing
                foreach ($geojsons as $index => $geojson) {
                    $data = json_decode($geojson, true);
                    $totalAreaInSquareMeters = 0;

                    foreach ($data['features'] as $feature) {
                        if (isset($feature['geometry']['coordinates'][0])) {
                            $coordinates = $feature['geometry']['coordinates'][0];
                            $totalAreaInSquareMeters += $this->calculatePolygonArea($coordinates);
                        }
                    }

                    $totalAreaInSquareKilometers = $totalAreaInSquareMeters / 1e6; // Konversi ke kilometer persegi

                    // Menyimpan hasil luas untuk GeoJSON ini
                    $areas[] = [
                        'geojsonIndex' => $index,
                        'areaInSquareMeters' => $totalAreaInSquareMeters,
                        'areaInSquareKilometers' => $totalAreaInSquareKilometers
                    ];
                }

                // Hanya mengakses value dari areaInSquareKilometers
                $areaInSquareKilometers = array_map(function ($area) {
                    return $area['areaInSquareKilometers'];
                }, $areas); 

                $chartSpots = app()
                    ->chartjs->name("SpotsChart")
                    ->type("bar")
                    ->size(["width" => 400, "height" => 200])
                    ->labels($labelSpots)
                    ->datasets([
                        [
                            "label" => "Spots area in Kilometer",
                            "backgroundColor" => "rgba(75, 192, 192, 0.2)",
                            "borderColor" => "rgba(75, 192, 192, 1)",
                            "data" => $areaInSquareKilometers
                        ]
                    ])
                    ->options([
                        'plugins' => [
                            'title' => [
                                'display' => true,
                                'text' => 'Yearly Spots Area'
                            ]
                        ]
                    ]);

                // chart report
                $start = Carbon::parse(Reports::min("date"));
                $end = Carbon::now();
                $period = CarbonPeriod::create($start, "1 year", $end);
                
                $reportsPerYear = collect($period)->map(function ($date) {
                    $endDate = $date->copy()->endOfYear();
                    $countPenghijauan = Reports::where("date", "<=", $endDate)
                                                ->where("category", "penghijauan")
                                                ->count();
                    $countKerusakan = Reports::where("date", "<=", $endDate)
                                                ->where("category", "kerusakan")
                                                ->count();
                
                    return [
                        "penghijauan" => $countPenghijauan,
                        "kerusakan" => $countKerusakan,
                        "year" => $endDate->format("Y")
                    ];
                });
                
                $dataPenghijauan = $reportsPerYear->pluck("penghijauan")->toArray();
                $dataKerusakan = $reportsPerYear->pluck("kerusakan")->toArray();
                $labels = $reportsPerYear->pluck("year")->toArray();
                
                $chartPenghijauan = app()
                    ->chartjs->name("PenghijauanChart")
                    ->type("line")
                    ->size(["width" => 400, "height" => 200])
                    ->labels($labels)
                    ->datasets([
                        [
                            "label" => "Penghijauan",
                            "backgroundColor" => "rgba(75, 192, 192, 0.2)",
                            "borderColor" => "rgba(75, 192, 192, 1)",
                            "data" => $dataPenghijauan
                        ]
                    ])
                    ->options([
                        'scales' => [
                            'x' => [
                                'type' => 'time',
                                'time' => [
                                    'unit' => 'year'
                                ],
                                'min' => $start->format("Y-m-d"),
                            ]
                        ],
                        'plugins' => [
                            'title' => [
                                'display' => true,
                                'text' => 'Yearly Reports for Penghijauan Category'
                            ]
                        ]
                    ]);
                
                $chartKerusakan = app()
                    ->chartjs->name("KerusakanChart")
                    ->type("bar")
                    ->size(["width" => 400, "height" => 200])
                    ->labels($labels)
                    ->datasets([
                        [
                            "label" => "Kerusakan",
                            "backgroundColor" => "rgba(255, 99, 132, 0.2)",
                            "borderColor" => "rgba(255, 99, 132, 1)",
                            "data" => $dataKerusakan
                        ]
                    ])
                    ->options([
                        'scales' => [
                            'x' => [
                                'type' => 'time',
                                'time' => [
                                    'unit' => 'year'
                                ],
                                'min' => $start->format("Y-m-d"),
                            ]
                        ],
                        'plugins' => [
                            'title' => [
                                'display' => true,
                                'text' => 'Yearly Reports for Kerusakan Category'
                            ]
                        ]
                    ]);

                return view('pemda.pemda-dashboard', compact(["chartPenghijauan", "chartKerusakan", "chartSpots"]), [
                    'kilo' => array_sum($areaInSquareKilometers) 
                ]);
            }
            else
            {
                return redirect()->back();
            }
        }
    }

    public function locations() {
        $spotCoords = Spot::all()->pluck('coordinates');
        $latestYear = Year::max('year');

        $spot = Spot::select('spots.*')
            ->join('spot_year', 'spots.id', '=', 'spot_year.spot_id')
            ->join('years', 'spot_year.year_id', '=', 'years.id')
            ->where('years.year', $latestYear)
            ->get();
        $years = Year::get();
        if(Auth::id())
        {
            $role=Auth()->user()->role;

            if($role=='User')
            {
                return view('user.frontend.maps', [
                    'spot' => $spot,
                    'spotCoords' => json_encode($spotCoords),
                    'years' => $years,
                ]);
            }
            else if($role=='Admin')
            {
                return view('admin.admin-dashboard');
            }   
            else if($role=='Pemda')
            {
                return view('pemda.frontend.maps', [
                    'spot' => $spot,
                    'spotCoords' => json_encode($spotCoords),
                    'years' => $years,
                ]);
            }
            else
            {
                return redirect()->back();
            }
        }
    }
    
    public function spot() {
        $spotCoords = Spot::all()->pluck('coordinates');
        $spots = Spot::all();
        $years = Year::get();

        return view('pemda.backend.spot.index', [
            'spots' => $spots,
            'spotCoords' => json_encode($spotCoords),
            'years' => $years,
        ]);
    }

    public function year() {
        $years = Year::all();

        return view('pemda.backend.year.index', [
            'years' => $years,
        ]);
    }

    public function map_year($id) {

        $yearSpot = Year::where('id',$id)->first();
        $spot = $yearSpot->getSpot()->get();
        return view('pemda.frontend.map_year',[
            'spot' => $spot,
            'yearSpot' => $yearSpot,
            // 'categories' => $this->categories
        ]);
    }


}


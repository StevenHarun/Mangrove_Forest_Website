<?php

namespace App\Http\Controllers;

use App\Models\Spot;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Year;
use App\Models\Reports;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::id())
        {
            $role=Auth()->user()->role;

            if($role=='User')
            {
                {
                    // Setting start and end dates
                    $start = Carbon::parse(Reports::min("date"));
                    $end = Carbon::now();
                    // Creating period
                    $period = CarbonPeriod::create($start, "1 month", $end);
                    // Colleting period per month
                    $reportsPerMonth = collect($period)->map(function ($date) {
                        $endDate = $date->copy()->endOfMonth();
                        $countPenghijauan = Reports::where("date", "<=", $endDate)
                                                    ->where("category", "penghijauan")
                                                    ->count();
                        $countKerusakan = Reports::where("date", "<=", $endDate)
                                                    ->where("category", "kerusakan")
                                                    ->count();
            
                        return [
                            "penghijauan" => $countPenghijauan,
                            "kerusakan" => $countKerusakan,
                            "month" => $endDate->format("Y-m-d")
                        ];
                    });
            
                    // Extracting data for the chart
                    $dataPenghijauan = $reportsPerMonth->pluck("penghijauan")->toArray();
                    $dataKerusakan = $reportsPerMonth->pluck("kerusakan")->toArray();
                    $labels = $reportsPerMonth->pluck("month")->toArray();
            
                    // Creating penghijauan chart
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
                                        'unit' => 'month'
                                    ],
                                    'min' => $start->format("Y-m-d"),
                                ]
                            ],
                            'plugins' => [
                                'title' => [
                                    'display' => true,
                                    'text' => 'Monthly Reports for Penghijauan Category'
                                ]
                            ]
                        ]);
    
                        // Creating kerusakan chart
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
                                            'unit' => 'month'
                                        ],
                                        'min' => $start->format("Y-m-d"),
                                    ]
                                ],
                                'plugins' => [
                                    'title' => [
                                        'display' => true,
                                        'text' => 'Monthly Reports for Kerusakan Category'
                                    ]
                                ]
                            ]);
                        return view('user.user-dashboard', compact(["chartPenghijauan", "chartKerusakan"]));
                }
            }
            else if($role=='Admin')
            {
                return view('admin.admin-dashboard');
            }   
            else if($role=='Pemda')
            {
                // Setting start and end dates
                $start = Carbon::parse(Reports::min("date"));
                $end = Carbon::now();
                // Creating period
                $period = CarbonPeriod::create($start, "1 month", $end);
                // Colleting period per month
                $reportsPerMonth = collect($period)->map(function ($date) {
                    $endDate = $date->copy()->endOfMonth();
                    $countPenghijauan = Reports::where("date", "<=", $endDate)
                                                ->where("category", "penghijauan")
                                                ->count();
                    $countKerusakan = Reports::where("date", "<=", $endDate)
                                                ->where("category", "kerusakan")
                                                ->count();
        
                    return [
                        "penghijauan" => $countPenghijauan,
                        "kerusakan" => $countKerusakan,
                        "month" => $endDate->format("Y-m-d")
                    ];
                });
        
                // Extracting data for the chart
                $dataPenghijauan = $reportsPerMonth->pluck("penghijauan")->toArray();
                $dataKerusakan = $reportsPerMonth->pluck("kerusakan")->toArray();
                $labels = $reportsPerMonth->pluck("month")->toArray();
        
                // Creating penghijauan chart
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
                                    'unit' => 'month'
                                ],
                                'min' => $start->format("Y-m-d"),
                            ]
                        ],
                        'plugins' => [
                            'title' => [
                                'display' => true,
                                'text' => 'Monthly Reports for Penghijauan Category'
                            ]
                        ]
                    ]);

                    // Creating kerusakan chart
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
                                        'unit' => 'month'
                                    ],
                                    'min' => $start->format("Y-m-d"),
                                ]
                            ],
                            'plugins' => [
                                'title' => [
                                    'display' => true,
                                    'text' => 'Monthly Reports for Kerusakan Category'
                                ]
                            ]
                        ]);
                    return view('pemda.pemda-dashboard', compact(["chartPenghijauan", "chartKerusakan"]));
            }
            else
            {
                return redirect()->back();
            }
        }
    }

    public function locations() {
        $spotCoords = Spot::all()->pluck('coordinates');
        $spot = Spot::get();
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


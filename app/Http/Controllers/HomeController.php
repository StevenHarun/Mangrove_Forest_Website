<?php

namespace App\Http\Controllers;

use App\Models\Spot;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Year;
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
                return view('user.user-dashboard');
            }
            else if($role=='Admin')
            {
                return view('admin.admin-dashboard');
            }   
            else if($role=='Pemda')
            {
                return view('pemda.pemda-dashboard');
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
            'categorySpot' => $yearSpot,
            // 'categories' => $this->categories
        ]);
    }


}


<?php

namespace App\Http\Controllers;

use App\Models\Spot;
use App\Models\Year;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpotController extends Controller
{
    public function create() {
        // $spotCoords = Spot::all()->pluck('coordinates');
        // $spot = Spot::get();
        $years = Year::get();

        return view('pemda.backend.spot.create', [
            'years' => $years,
        ]);
    }

    public function store(Request $req) {
        $spot = new Spot();

        $spot->name = request('name');
        $spot->slug = Str::slug($req->name);
        $spot->address = request('address');
        $spot->coordinates = request('coordinates');
        $spot->fillColor = request('fillColor');
        $spot->save();
        $spot->getYear()->sync($req->year_id);  


        return redirect('/locations/spot')->with('msg', 'Location has been added!');
    }

    public function update(Request $req, $id) {
        $spot = Spot::findOrFail($id);

        $spot->name = request('name');
        $spot->slug = Str::slug($req->name);
        $spot->address = request('address');
        $spot->coordinates = request('coordinates');
        $spot->fillColor = request('fillColor');
        $spot->update();
        $spot->getYear()->sync($req->year_id);  


        return redirect('/locations/spot')->with('msg', 'Location has been updated!');
    }

    public function destroy($id) {
        $spot = Spot::findOrFail($id);

        $spot->getYear()->detach();
        $spot->delete();

 
        return redirect('/locations/spot')->with('msg', 'Location has been deleted!');
    }

    public function details($param) {
        // $spot = Spot::findOrFail($slug);
        $years = Year::get();
        // dd($spot);

        $spot = Spot::where('id', $param)
                ->orWhere('slug', $param)
                ->firstOrFail();

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
                return view('pemda.backend.spot.update', [
                    'spot'=> $spot,
                    'years' => $years,
                ]);
            }
            else
            {
                return redirect()->back();
            }
        }
    
    }
}

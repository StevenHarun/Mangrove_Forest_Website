<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class YearController extends Controller
{
    public function create() {

        return view('pemda.backend.year.create', [
        ]);
    }

    public function store(Request $req) {
        $year = new Year();

        $year->year = request('year');
        $year->slug = Str::slug($req->year);
        $year->save();


        return redirect('/locations/year')->with('msg', 'Year has been added');
    }

    public function update(Request $req, $id) {
        $year = Year::findOrFail($id);

        $year->year = request('year');
        $year->slug = Str::slug($req->year);
        $year->update();


        return redirect('/locations/year')->with('msg', 'Year has been updated!');
    }

    public function destroy($id) {
        $year = Year::findOrFail($id);

        $year->delete();

 
        return redirect('/locations/year')->with('msg', 'Year has been deleted!');
    }

    public function details($id) {
        $year = Year::findOrFail($id);


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
                return view('pemda.backend.year.update', [
                    'year' => $year,
                ]);
            }
            else
            {
                return redirect()->back();
            }
        }
    
    }
}

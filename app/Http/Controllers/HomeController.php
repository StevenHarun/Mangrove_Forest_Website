<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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

    // public function post()
    // {
    //     return view('admin.post');
    // }
}


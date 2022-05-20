<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        if(auth()->check()) {
            return redirect(route('dashboard.index'));
        }

        return redirect(route('login'));
    }
}
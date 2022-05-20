<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{ User, Quiz, Take, TakeAnswer, QuizCategory };
use App\Traits\ChartData;

class DashboardController extends Controller
{
    use ChartData;

    public function index(Request $request)
    {
        return view('dashboard.index', []);
    }
}
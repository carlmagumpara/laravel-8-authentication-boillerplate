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
        if (auth()->user()->role->slug === 'admin') {
          return view('dashboard.index', [
              'users_count' => User::where(['role_id' => 3])->count(),
              'chart' => $this->adminChartData(),
          ]);
        }

        return view('dashboard.index', []);
    }
}
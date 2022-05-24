<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{ User };
use App\Traits\ChartData;
use App\Services\TwilioSms;

class DashboardController extends Controller
{
    use ChartData;

    public function index(Request $request)
    {

        // TwilioSms::send([
        //     'number' => '09507803663',
        //     'country' => 'PH',
        //     'content' => 'Hey',
        // ]);


        if (auth()->user()->role->slug === 'admin') {
          return view('dashboard.index', [
              'users_count' => User::where(['role_id' => 3])->count(),
              'chart' => $this->adminChartData(),
          ]);
        }

        return view('dashboard.index', []);
    }
}
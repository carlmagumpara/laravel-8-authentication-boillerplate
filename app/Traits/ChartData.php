<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Models\{ User };

trait ChartData
{
    public function generateData($type, $length, $model, $isAdmin = false, $conditions = [])
    {
        $data = [];

        for ($i = $length; $i >= 0; $i--) { 
            $data[] = $model->whereBetween('created_at', [Carbon::now()->subMonth($i)->startOfMonth(), Carbon::now()->subMonth($i)->endOfMonth()])->where($conditions)->count();
        }

        return $data;
    }

    public function generateMonthData($length)
    {
        $data = [];

        for ($i = $length; $i >= 0; $i--) { 
            $data[] = Carbon::now()->subMonth($i)->format('M').' '.Carbon::now()->subMonth($i)->format('Y');
        }

        return $data;
    }

    public function adminChartData($count = 8)
    {
        return [
            'eightMonths' => json_encode($this->generateMonthData($count)),
            'eightMonthsData' => json_encode([
                'Students' => $this->generateData('Users', $count, new User, true, ['role_id' => 3]),
                'Teachers' => $this->generateData('Users', $count, new User, true, ['role_id' => 2]),
            ])
        ];
    }
}

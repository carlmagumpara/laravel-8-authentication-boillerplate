<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        foreach (auth()->user()->unreadNotifications as $notification) {
            $notification->update(['read_at' => now(), 'data->opened' => true]);
        }

        if ($request->type && $request->type != 'all') {
            return auth()->user()->notifications()->where('data->key', $request->type)->paginate($request->per_page ?? 10);
        }
        
        return auth()->user()->notifications()->paginate($request->per_page ?? 10);
    }

    public function count()
    {
        return auth()->user()->unreadNotifications->count();
    }
}
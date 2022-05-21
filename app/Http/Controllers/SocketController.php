<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Pusher\Pusher;

class SocketController extends Controller
{
    public function __construct()
    {
        $config = config('broadcasting.connections.pusher');
        $this->pusher = new Pusher($config['key'], $config['secret'], $config['app_id'], $config['options']);
    }

    public function broadcastingPrivateAuth(Request $request)
    {
        \Log::info($request->all());
        
        return $this->pusher->socket_auth($request->channel_name, $request->socket_id);
    }

    public function broadcastingPresenceAuth(Request $request)
    {
        \Log::info($request->all());

        return $this->pusher->presence_auth($request->channel_name, $request->socket_id, $request->user()->id, ['user_id' => $request->user()->id]);
    }
}
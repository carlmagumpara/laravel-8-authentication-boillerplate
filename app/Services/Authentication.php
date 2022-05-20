<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Mail;
use App\Mail\SendVerificationCode;

class Authentication
{
    public function generateTokenCode($user)
    {
        $code = (string) random_int(100000, 999999);
        $token = bin2hex(random_bytes(16));
        $url = route('verification', [
            'token' => $token,
            'email' => $user->email,
        ]);

        Cache::put('verification.'.$token, [
            'id' => $user->id,
            'code' => $code,
        ], now()->addMinutes(5));

        Mail::to($user->email)->send(new SendVerificationCode($user, $code, $url));

        return [
            'token' => $token,
            'url' => $url,
        ];
    }
}

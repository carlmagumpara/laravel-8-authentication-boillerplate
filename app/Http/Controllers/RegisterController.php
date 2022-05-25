<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use App\Services\Authentication;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\{ RegisterRequest, VerificationCodeRequest };
use App\Helpers\Utils;

class RegisterController extends Controller
{
    private $authentication;

    public function __construct(
        Authentication $authentication
    )
    {
        $this->authentication = $authentication;
    }

    public function index(Request $request)
    {
        return view('auth.register', $request->all());
    }

    public function register(RegisterRequest $request)
    {
        $request->merge([
            'is_active' => true,
            'status' => 'Pending',
            'password' => Hash::make($request->password),
        ]);

        try {
            $verification = DB::transaction(function () use ($request) {
                $user = User::create($request->except(['password_confirmation']));

                return $this->authentication->generateTokenCode($user);
             });

            return response()->json([
                'dont_show_alert' => true,
                'redirect_url' => $verification['url'],
                'message' => 'Registered successfully. Please check your email for verification link/code.',
                'success' => true,
            ], 200);
        } catch (\Exception $e) {
            \Log::info($e);
            return response()->json([
                'message' => 'Register details are not valid.',
                'success' => false,
            ], 200);
        }
    }

    public function verification($token, Request $request)
    {
        return view('auth.verification', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function verify(VerificationCodeRequest $request)
    {
        $cacheKey = 'verification.'.$request->token;
        $verification = Cache::get($cacheKey);

        if (! $verification || $verification['code'] !== $request->code) {
            return response()->json([
                'message' => 'Invalid code.',
                'success' => false,
            ], 200);
        }

        $user = User::find($verification['id']);

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'redirect_url' => redirect(route('login'))->getTargetUrl(),
                'message' => 'User already verified. You can now login.',
                'success' => true,
            ], 200);
        }

        try {
            DB::transaction(function() use ($user) {
                $user->markEmailAsVerified();
            });

            Auth::login($user);

            $quizCode = Cache::get('quiz-code') ?? null;

            return response()->json([
                'redirect_url' => ! empty($quizCode) ? redirect(route('quiz.start.quiz.landing', $quizCode))->getTargetUrl() : redirect(route('dashboard.index'))->getTargetUrl(),
                // 'redirect_url' => redirect(route('login'))->getTargetUrl(),
                'message' => 'Email verified. You can now login.',
                'success' => true,
            ], 200);
        } catch (\Exception $exception) {
            return response()->error('Erorr', 401);
        }
    }

    public function resendVerificationCode(Request $request)
    {
        $user = User::where(['email' => $request->email])->first();
        
        $verification = DB::transaction(function () use ($request, $user) {
            return $this->authentication->generateTokenCode($user);
         });

        return response()->json([
            'redirect_url' => $verification['url'],
            'message' => 'Verification code sent.',
            'success' => true,
        ], 200);
    }
}

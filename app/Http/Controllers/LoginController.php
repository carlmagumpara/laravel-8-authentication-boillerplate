<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Session;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Services\Authentication;
use Illuminate\Validation\ValidationException;
use Hash;

class LoginController extends Controller
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
        return view('auth.login', $request->all());
    }

    public function logIn(LoginRequest $request)
    {
        $user = User::where(['email' => $request->email])->first();

        if (! $user) {
            throw ValidationException::withMessages(['email' => 'Email address or password not match.']);
        }

        if ($user->status === 'Suspended') {
            throw ValidationException::withMessages(['email' => 'Your account has been suspended please contact support for more information.']);
        }

        if (! $user->email_verified_at) {
            $verification = DB::transaction(function () use ($request, $user) {
                return $this->authentication->generateTokenCode($user);
             });

            return response()->json([
                'redirect_url' => $verification['url'],
                'message' => 'Your email is not verified. Please check the code sent to your email.',
                'success' => true,
            ], 200);
        }

        if (Hash::check($request->password, $user->password)) {

            Auth::login($user);

            return response()->json([
                'redirect_url' => ! empty($request->quiz_code) ? redirect(route('quiz.start.quiz.landing', $request->quiz_code))->getTargetUrl() : redirect(route('dashboard.index'))->getTargetUrl(),
                'message' => 'You are logged in!',
                'dont_show_alert' => true,
                'success' => true,
            ], 200);
        }

        throw ValidationException::withMessages(['email' => 'Email address or password not match.']);
    }

    public function logOut() 
    {
        Session::flush();
        Auth::logout();
  
        return redirect(route('login'))->withSuccess('You are logout successfully');
    }
}
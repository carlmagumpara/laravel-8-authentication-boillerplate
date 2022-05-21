<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\{
    LandingController, 
    LoginController, 
    RegisterController,
    UserController,
    DashboardController,
    QuizController,
    QuizQuestionController,
    ProfileController,
    LeaderboardController,
    TakeController,
    QuizCategoryController,
    FaqController,
    SocketController,
};

// Public
Route::get('/', [LandingController::class, 'index'])->name('index');

Route::post('logout', [LoginController::class, 'logOut'])->name('logout');

Route::middleware(['guest'])->group(function () {
    // Login
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'logIn'])->name('post.login'); 
    // Register
    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'register'])->name('post.register');

    Route::get('verification/{token}', [RegisterController::class, 'verification'])->name('verification');
    Route::post('verify', [RegisterController::class, 'verify'])->name('verification.post');
    Route::post('verify/resend', [RegisterController::class, 'resendVerificationCode'])->name('verification.resend');

    // Email Verification
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect(route('index'))->withSuccess('Email successfully verified.');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    // Forgot Password
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->middleware('guest')->name('password.request');
    Route::post('/forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return response()->json([
            'redirect_url' => redirect(route('login'))->getTargetUrl(),
            'message' => $status === Password::RESET_LINK_SENT ? 'We have e-mailed your password reset link!' : 'Error sending password reset link.',
            'success' => true,
        ], 200);
    })->middleware('guest')->name('password.email');

    Route::get('/reset-password/{token}', function ($token) {
        return view('auth.reset-password', ['token' => $token]);
    })->middleware('guest')->name('password.reset');

    Route::post('/reset-password', function (Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return response()->json([
            'redirect_url' => redirect(route('login'))->getTargetUrl(),
            'message' => $status === Password::PASSWORD_RESET ? 'You\'ve successfully changed your password!' : 'Error changing your password',
            'success' => true,
        ], 200);
    })->middleware('guest')->name('password.update');
});

Route::middleware(['auth'])->group(function () {

    // Route::post('broadcasting/auth', [SocketController::class, 'broadcastingPrivateAuth']);
    Route::post('broadcasting/auth', [SocketController::class, 'broadcastingPresenceAuth']);

    Route::prefix('user')->name('user.')->group(function () {
        Route::middleware(['admin'])->group(function () {
            Route::get('/{type}', [UserController::class, 'index'])->name('list');
            Route::post('/create', [UserController::class, 'create'])->name('create');
            Route::post('/update/{id}', [UserController::class, 'update'])->name('update');
            Route::post('/delete', [UserController::class, 'destroy'])->name('delete');
            Route::post('/restore', [UserController::class, 'restore'])->name('restore');
        });
        Route::get('/show/{id}', [UserController::class, 'show'])->name('show');
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::prefix('update')->name('update.')->group(function () {
            Route::post('/', [ProfileController::class, 'update'])->name('user');
            Route::post('/profile-photo', [ProfileController::class, 'updateProfilePhoto'])->name('profile-photo');
        });
    });
    
    Route::middleware(['admin'])->group(function () {
        Route::prefix('faq')->name('faq.')->group(function () {
            Route::get('/', [FaqController::class, 'index'])->name('list');
            Route::post('/create', [FaqController::class, 'create'])->name('create');
            Route::post('/update/{id}', [FaqController::class, 'update'])->name('update');
            Route::post('/delete', [FaqController::class, 'destroy'])->name('delete');
        });
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});
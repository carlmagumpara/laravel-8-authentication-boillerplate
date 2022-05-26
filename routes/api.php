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
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Http\Controllers\{
    LandingController, 
    LoginController, 
    RegisterController,
    UserController,
    DashboardController,
    ProfileController,
    FaqController,
    SocketController,
};

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('broadcasting/auth', [SocketController::class, 'broadcastingPresenceAuth']);

    // Route::prefix('notifications')->group(function () {
    //     Route::get('/', [NotificationController::class, 'index']);
    //     Route::get('count', [NotificationController::class, 'count']);
    // });

    // Route::prefix('inbox')->group(function () {
    //     Route::get('/', [InboxController::class, 'index']);
    //     Route::get('/unread', [InboxController::class, 'unread']);
    //     Route::post('/create', [InboxController::class, 'create']);
    //     Route::get('/show/{conversation_id}', [InboxController::class, 'show']);
    //     Route::post('/send/{conversation_id}', [InboxController::class, 'send']);
    // });

    // Route::prefix('user')->group(function () {
    //     Route::get('/search', [UserController::class, 'search']);
    //     Route::get('/me', [UserController::class, 'me']);
    //     Route::get('/profile/{id}', [UserController::class, 'profile']);
    //     Route::post('unfollow', [UserController::class, 'unfollow']);
    //     Route::post('follow', [UserController::class, 'follow']);
    //     Route::prefix('profile')->group(function () {
    //         Route::prefix('update')->group(function () {
    //             Route::post('/', [ProfileController::class, 'update']);
    //             Route::post('/profile-photo', [ProfileController::class, 'updateProfilePhoto']);
    //             Route::post('/cover-photo', [ProfileController::class, 'updateCoverPhoto']);
    //             Route::post('/password', [ProfileController::class, 'updatePassword']);
    //         });
    //     });
    // });
});
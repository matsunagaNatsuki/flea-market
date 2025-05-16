<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\LoginRequest;


class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);

        Fortify::registerView(function () {
            return view('auth.register');
        });

        Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::redirects('register', '/mypage/profile');

        RateLimiter::for('login', function (Request $request) {
            $email =$request->input(Fortify::username());

            return Limit::perMinute(10)->by($email . $request->ip());
        });

        Route::post('/logout', function (Request $request) {
            Auth::logout();
            return redirect('/login')->with('message', 'ログアウトしました');
        })->name('logout');

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->input('email'))->first();

            if ($user && Hash::check($validated['password'], $user->password)) {
                Auth::login($user);
                return $user;
            }

            return null;
        });

        Fortify::authenticateUsing(function ($request) {
            $loginRequest =new LoginRequest();
            $validated = $loginRequest->validate($request->all());
            return auth()->attempt([
                'email' => $validated['email'],
                'password' => $validated['password']
            ]);
        });
    }
}
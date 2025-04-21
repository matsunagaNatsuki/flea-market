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

        Fortify::authenticateUsing(function ($request) {
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'email'],
                'password' => ['required']
            ], [
                'email,required' => 'メールアドレスを入力してください',
                'password.required' =>'パスワードを入力してください',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $validated = $validator->validated();

            $user = User::where('email', $validated['email'])->first();

            if (!$user || !Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
                return response()->json(['errors' => ['login' => 'ログイン情報が登録されていません。']], 422);
            }

            return $user;
        });
    }
}
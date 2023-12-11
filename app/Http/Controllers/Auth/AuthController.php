<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\OtpSmsNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->method() == 'GET' && auth()->check() == false) {
            return view('auth.login');
        }

        $validatedData = $request->validate([
            'cellphone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11'
        ]);

        try {
            $user = User::where('cellphone', $validatedData['cellphone'])->first();
            $otpCode = rand(100000, 999999);
            $loginToken = sha1(Str::random(50));

            if ($user) {
                $user->update([
                    'otp' => $otpCode,
                    'login_token' => $loginToken,
                ]);
            } else {
                $user = User::create([
                    'cellphone' => $validatedData['cellphone'],
                    'otp' => $otpCode,
                    'login_token' => $loginToken,
                ]);
            }

            $user->notify((new OtpSmsNotification($otpCode)));

            return response([
                'login_token' => $loginToken,
                'cellphone' => $validatedData['cellphone'],
            ], 200);

        } catch (\Exception $e) {
            return response([
                'error' => $e->getMessage(),
            ], 422);
        }

    }

    public function checkOtp(Request $request)
    {
        $validatedData = $request->validate([
            'login_token' => 'required',
            'otp' => 'required|digits:6',
        ]);

        try {
            $user = User::where('login_token', $validatedData['login_token'])->firstOrFail();

            if ($user->otp == $validatedData['otp']) {
                auth()->login($user, $remember = true);
                return response(['success' => 'ورود انجام شد'], 200);
            } else {
                return response(['errors' => ['otp' => ['کد تایید نادرست است']]], 422);
            }
        } catch (\Exception $e) {
            return response([
                'error' => $e->getMessage(),
            ], 422);
        }
    }

    public function resendOtp(Request $request)
    {
        $validatedData = $request->validate([
            'login_token' => 'required'
        ]);

        try {
            $user = User::where('login_token', $validatedData['login_token'])->firstOrFail();
            $otpCode = rand(100000, 999999);
            $loginToken = sha1(Str::random(50));

            if ($user) {
                $user->update([
                    'otp' => $otpCode,
                    'login_token' => $loginToken,
                ]);
            }

            $user->notify((new OtpSmsNotification($otpCode)));

            return response([
                'login_token' => $loginToken,
            ], 200);

        } catch (\Exception $e) {
            return response([
                'error' => $e->getMessage(),
            ], 422);
        }
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('home.index');
    }

}

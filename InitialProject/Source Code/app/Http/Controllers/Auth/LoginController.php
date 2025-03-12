<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    use ThrottlesLogins;

    protected $redirectTo = RouteServiceProvider::HOME;
    protected $maxAttempts = 50; // Default is 5
    protected $decayMinutes = 5; // Default is 1

    public function __construct()
    {
        $this->middleware(['guest'])->except('logout');
    }

    public function username()
    {
        return 'email';
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerate();
        Auth::logout();
        return redirect('/login');
    }

    protected function redirectTo()
    {
        if (Auth::user()->hasRole('admin')) {
            return route('dashboard');
        } elseif (Auth::user()->hasRole('staff')) {
            return route('dashboard');
        } elseif (Auth::user()->hasRole('teacher')) {
            return route('dashboard');
        } elseif (Auth::user()->hasRole('student')) {
            return route('dashboard');
        }
    }

    public function login(Request $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        $credentials = $request->only('username', 'password');
        $response = $request->input('recaptcha'); // ใช้ input แทน request()

        $data = [
            "username" => $credentials['username'],
            "password" => $credentials['password']
        ];

        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        $validator = Validator::make($data, $rules);
        $input = $request->all();
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (!$validator->fails()) {
            if (auth()->attempt([$fieldType => $input['username'], 'password' => $input['password']]) && $this->checkValidGoogleRecaptchaV3($response)) {
                // Login สำเร็จ
                if (Auth::user()->hasRole('admin')) {
                    return redirect()->route('dashboard');
                } elseif (Auth::user()->hasRole('student')) {
                    return redirect()->route('dashboard');
                } elseif (Auth::user()->hasRole('staff')) {
                    return redirect()->route('dashboard');
                } elseif (Auth::user()->hasRole('teacher')) {
                    return redirect()->route('dashboard');
                }
            } else {
                // Login ล้มเหลว - บันทึก Logs
                Log::channel('access')->info('Login Failed', [
                    'ip' => $request->ip(),
                    'port' => $request->getPort(),
                    'status' => 401, // Unauthorized
                    'method' => $request->method(),
                    'url' => $request->fullUrl(),
                    'user_id' => null,
                    'email' => $input['username'], // อีเมลหรือ username ที่พยายามล็อกอิน
                    'first_name' => null,
                    'last_name' => null,
                    'timestamp' => now()->toDateTimeString(),
                    'message' => 'Login attempt failed'
                ]);

                $this->incrementLoginAttempts($request);
                return redirect()->back()
                    ->withInput($request->all())
                    ->withErrors(['error' => 'Login Failed: Your user ID or password is incorrect']);
            }
        } else {
            return redirect('login')->withErrors($validator->errors())->withInput();
        }
    }

    public function checkValidGoogleRecaptchaV3($response)
    {
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $data = [
            'secret' => "6Ldpye4ZAAAAAKwmjpgup8vWWRwzL9Sgx8mE782u",
            'response' => $response
        ];
        $options = [
            'http' => [
                'header' => 'Content-Type: application/x-www-form-urlencoded\r\n',
                'method' => 'POST',
                'content' => http_build_query($data)
            ]
        ];
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $resultJson = json_decode($result);
        return $resultJson->success;
    }
}
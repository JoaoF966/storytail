<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Login') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: url('{{ asset("images/background_login.jpg") }}') no-repeat center center;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: white;
            width: 350px;
            padding: 30px 20px;
            border-radius: 15px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .login-container h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            font-size: 16px;
            color: white;
            background: linear-gradient(to right, #FF6600, #FF0099);
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .login-container button:hover {
            transform: scale(1.05);
        }

        .login-container .forgot-password {
            display: block;
            text-align: right;
            margin-top: 10px;
            color: #888;
            text-decoration: none;
            font-size: 12px;
        }

        .login-container .forgot-password:hover {
            color: #FF6600;
        }

        .login-container .social-login {
            margin-top: 20px;
        }

        .login-container .social-login p {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .login-container .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .login-container .social-icons a img {
            width: 30px;
            height: 30px;
            transition: transform 0.3s ease;
        }

        .login-container .social-icons a img:hover {
            transform: scale(1.2);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
            <div style="margin-bottom: 20px;">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div style="margin-bottom: 20px;">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Forgot Password -->
            <a href="{{ route('password.request') }}" class="forgot-password">Forgot password?</a>

            <!-- Login Button -->
            <button type="submit">Login</button>
        </form>

        <!-- Social Login -->
        <div class="social-login">
            <p>Or sign up using</p>
            <div class="social-icons">
                <a href="#"><img src="{{ asset('images/insta.png') }}" alt="Instagram"></a>
                <a href="#"><img src="{{ asset('images/facebook.png') }}" alt="Facebook"></a>
                <a href="#"><img src="{{ asset('images/twitter.png') }}" alt="Twitter"></a>
                <a href="#"><img src="{{ asset('images/tiktok.png') }}" alt="TikTok"></a>
            </div>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Sign Up') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            display: flex;
            height: 100vh;
            background: #f9f9f9;
        }

        .signup-container {
            display: flex;
            width: 100%;
        }

        .signup-container .image {
            width: 50%;
            background: url('{{ asset("images/img_sign.jpg") }}') no-repeat center center;
            background-size: cover;
        }

        .signup-container .form-container {
            width: 50%;
            padding: 40px;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-container h1 {
            font-size: 28px;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .form-container form {
            max-width: 400px;
            margin: 0 auto;
        }

        .form-container form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-container form .checkbox-container {
            display: flex;
            align-items: center;
            font-size: 12px;
            margin: 10px 0;
        }

        .form-container form .checkbox-container input {
            margin-right: 10px;
        }

        .form-container form button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            color: white;
            background: linear-gradient(to right, #FF6600, #FF0099);
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .form-container form button:hover {
            transform: scale(1.05);
        }

        .form-container .signin-link {
            text-align: center;
            margin-top: 15px;
            font-size: 12px;
        }

        .form-container .signin-link a {
            color: #FF6600;
            text-decoration: none;
            font-weight: bold;
        }

        .form-container .signin-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <!-- Imagem -->
        <div class="image"></div>

        <!-- Formulário -->
        <div class="form-container">
            <h1>Sign Up</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- First Name -->
                <div>
                    <x-input-label for="name" :value="__('First Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full"
                                  type="password"
                                  name="password"
                                  required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                  type="password"
                                  name="password_confirmation" required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Checkbox -->
                <div class="checkbox-container">
                <input type="checkbox" name="terms" id="terms" required style="width: 16px; height: 16px; margin-right: 10px;">
                <label for="terms">I agree to the <a href="/terms" target="_blank" style="color: #FF6600; text-decoration: underline;">Terms of Use</a></label>
                </div>

                <!-- Sign Up Button -->
                <button type="submit">Sign up</button>
            </form>

            <!-- Sign In Link -->
            <div class="signin-link">
                <span>Already have an account? <a href="{{ route('login') }}">Sign in &raquo;</a></span>
            </div>
        </div>
    </div>
</body>
</html>

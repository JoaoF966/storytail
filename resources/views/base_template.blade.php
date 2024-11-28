<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Storytail') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F5F5F5;
        }

        header {
            position: relative;
            height: 300px;
            color: white;
            background: url('{{ asset('images/forest-background.jpg') }}') no-repeat center center;
            background-size: cover;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        header .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
        }
        header .top-bar .logo {
            background-color: #E56309;
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }
        header .top-bar .logo img {
            height: 70px;
        }
        header nav {
            display: flex;
            gap: 20px;
        }
        header nav a {
            color: white;
            text-decoration: none;
            font-size: 1rem;
            padding: 8px 15px;
        }
        header nav a:hover {
            text-decoration: underline;
        }
        header .buttons a {
            background-color: white;
            color: #333;
            text-decoration: none;
            font-size: 1rem;
            padding: 10px 20px;
            border-radius: 25px;
            margin-left: 10px;
        }
        header .buttons a:hover {
            background-color: #FF6600;
            color: white;
        }
        header .search-bar {
            text-align: center;
            padding: 20px;
        }
        header .search-bar h1 {
            font-size: 2rem;
            margin-bottom: 20px;
        }
        header .search-bar input {
            padding: 15px;
            width: 300px;
            max-width: 80%;
            border: none;
            border-radius: 25px;
            margin-right: 10px;
        }
        header .search-bar button {
            padding: 15px 25px;
            border: none;
            background-color: #FF6600;
            color: white;
            border-radius: 25px;
            cursor: pointer;
        }
        header .search-bar button:hover {
            background-color: white;
            color: #FF6600;
        }

        /* Footer */
        footer {
            background-color: black;
            color: white;
            text-align: center;
            padding: 20px 40px;
            position: relative;
        }
        footer .footer-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }
        footer .footer-logo img {
            height: 40px;
            margin-bottom: 10px;
        }
        footer .links {
            display: flex;
            justify-content: center;
            gap: 30px;
        }
        footer .links a {
            color: white;
            text-decoration: none;
        }
        footer .links a:hover {
            color: #FF6600;
        }
        footer .social {
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        footer .social img {
            height: 25px;
            cursor: pointer;
            transition: transform 0.3s;
        }
        footer .social img:hover {
            transform: scale(1.2);
        }
        footer p {
            font-size: 0.9rem;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="logo">
                <img src="{{ asset('images/logotop.png') }}" alt="Storytail Logo">
            </div>
            <nav>
                <a href="/new-books">New Books</a>
                <a href="/picks">Our Picks</a>
                <a href="/subscribe">Subscribe</a>
                <a href="/popular">Most Popular</a>
            </nav>
            <div class="buttons">
                <a href="{{ route('login') }}">Sign In</a>
                <a href="{{ route('register') }}">Register</a>
            </div>
        </div>
        <!-- Search Bar -->
        <div class="search-bar">
            <h1>FIND YOUR BOOK</h1>
            <input type="text" placeholder="Search...">
            <button>Search</button>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <div class="container p-5">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <img src="{{ asset('images/logofim.png') }}" alt="Storytail Footer Logo">
            </div>
            <div class="links">
                <a href="/books">Books</a>
                <a href="/pricing">Pricing</a>
                <a href="/support">Support</a>
                <a href="/login">Login</a>
                <a href="/terms">Terms</a>
            </div>
            <div class="social">
                <a href="https://tiktok.com"><img src="{{ asset('images/tiktok.png') }}" alt="TikTok"></a>
                <a href="https://instagram.com"><img src="{{ asset('images/insta.png') }}" alt="Instagram"></a>
                <a href="https://facebook.com"><img src="{{ asset('images/facebook.png') }}" alt="Facebook"></a>
            </div>
            <p>&copy; {{ date('Y') }} storytail.pt</p>
        </div>
    </footer>

<script src="/js/app.js"></script>
</body>
</html>

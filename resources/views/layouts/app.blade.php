<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Windkracht-12 KiteSurfSchool')</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    @if(file_exists(public_path('build/manifest.json')))
        @php
            $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
        @endphp
        @if(isset($manifest['resources/css/app.css']))
            <link rel="stylesheet" href="{{ asset('build/' . $manifest['resources/css/app.css']['file']) }}">
        @endif
    @endif
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html, body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            line-height: 1.6;
            color: #1f2937;
            background: #f9fafb;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
        }
        
        /* Navigation */
        nav {
            background: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            position: sticky;
            top: 0;
            z-index: 50;
        }
        
        nav .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
        }
        
        nav .logo {
            font-size: 1.5rem;
            font-weight: 800;
            color: #0369a1;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
            letter-spacing: -0.5px;
        }
        
        nav .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }
        
        nav .nav-links a {
            color: #4b5563;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.3s;
        }
        
        nav .nav-links a:hover {
            color: #0369a1;
        }
        
        nav .nav-auth {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        
        nav .btn {
            padding: 0.6rem 1.2rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }
        
        nav .btn-primary {
            background: linear-gradient(135deg, #0369a1 0%, #0ea5e9 100%);
            color: white;
        }
        
        nav .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(3, 105, 161, 0.3);
        }
        
        nav .btn-secondary {
            color: #0369a1;
            border: 1.5px solid #0369a1;
            background: transparent;
        }
        
        nav .btn-secondary:hover {
            background: #f0f9ff;
        }
        
        /* User Menu */
        .user-menu-btn {
            background: linear-gradient(135deg, #0369a1 0%, #0ea5e9 100%);
            color: white;
            padding: 0.7rem 1rem;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            transition: all 0.3s;
        }
        
        .user-menu-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(3, 105, 161, 0.3);
        }
        
        .dropdown-menu {
            position: absolute;
            right: 0;
            top: 100%;
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            min-width: 200px;
            margin-top: 0.5rem;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s;
        }
        
        .user-menu:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .dropdown-menu a, .dropdown-menu button {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            border: none;
            background: none;
            text-align: left;
            color: #4b5563;
            text-decoration: none;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.2s;
            border-bottom: 1px solid #f3f4f6;
        }
        
        .dropdown-menu a:last-child, .dropdown-menu button:last-child {
            border-bottom: none;
        }
        
        .dropdown-menu a:hover, .dropdown-menu button:hover {
            background: #f9fafb;
            color: #0369a1;
        }
        
        /* Alerts */
        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            border-left: 4px solid;
        }
        
        .alert-success {
            background: #f0fdf4;
            border-color: #22c55e;
            color: #16a34a;
        }
        
        .alert-error {
            background: #fef2f2;
            border-color: #ef4444;
            color: #dc2626;
        }
        
        /* Main Container */
        main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        
        /* General Utilities */
        .text-center { text-align: center; }
        .flex { display: flex; }
        .flex-col { flex-direction: column; }
        .items-center { align-items: center; }
        .justify-center { justify-content: center; }
        .gap-4 { gap: 1rem; }
        .gap-6 { gap: 1.5rem; }
        .px-4 { padding-left: 1rem; padding-right: 1rem; }
        .py-8 { padding-top: 2rem; padding-bottom: 2rem; }
        .mb-4 { margin-bottom: 1rem; }
        .mb-6 { margin-bottom: 1.5rem; }
        .mt-8 { margin-top: 2rem; }
        .rounded-lg { border-radius: 0.5rem; }
        .rounded-xl { border-radius: 0.75rem; }
        .rounded-2xl { border-radius: 1rem; }
        .shadow-sm { box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
        .shadow-lg { box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        .transition { transition: all 0.3s ease; }
        .w-full { width: 100%; }
        
        @media (max-width: 768px) {
            nav .nav-links {
                display: none;
            }
            
            .md\:hidden {
                display: none !important;
            }
            
            main {
                padding: 0 1rem;
            }
        }
        
        @media (min-width: 769px) {
            .md\:hidden {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo">Windkracht-12</a>
            
            <ul class="nav-links md:hidden">
                <li><a href="{{ route('home') }}">Thuispagina</a></li>
                <li><a href="{{ route('packages') }}">Pakketten</a></li>
                <li><a href="{{ route('locations') }}">Locaties</a></li>
                <li><a href="{{ route('about') }}">Over Ons</a></li>
            </ul>
            
            <div class="nav-auth">
                @auth
                    <div class="user-menu" style="position: relative;">
                        <button class="user-menu-btn">
                            <span style="font-size: 1.2rem;">👤</span>
                            {{ Auth::user()->email }}
                        </button>
                        <div class="dropdown-menu">
                            <div style="padding: 0.75rem 1rem; border-bottom: 1px solid #f3f4f6;">
                                <div style="font-weight: 600; color: #1f2937; font-size: 0.9rem;">{{ Auth::user()->email }}</div>
                                <div style="font-size: 0.8rem; color: #9ca3af; text-transform: capitalize; margin-top: 0.25rem;">{{ Auth::user()->role }}</div>
                            </div>
                            @if(Auth::user()->role === 'customer')
                                <a href="{{ route('customer.dashboard') }}">Dashboard</a>
                                <a href="{{ route('customer.personal-info') }}">Profiel</a>
                                <a href="{{ route('customer.make-reservation') }}">Nieuwe Reservering</a>
                            @elseif(Auth::user()->role === 'instructor')
                                <a href="{{ route('instructor.dashboard') }}">Dashboard</a>
                                <a href="{{ route('instructor.personal-info') }}">Profiel</a>
                                <a href="{{ route('instructor.schedule') }}">Schema</a>
                            @elseif(Auth::user()->role === 'owner')
                                <a href="{{ route('owner.dashboard') }}">Dashboard</a>
                                <a href="{{ route('owner.personal-info') }}">Profiel</a>
                                <a href="{{ route('owner.customers') }}">Klanten</a>
                            @endif
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" style="color: #dc2626;">Uitloggen</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-secondary">Inloggen</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Registreren</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Alerts -->
    <main style="margin-top: 2rem;">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>Succes!</strong> {{ $message }}
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-error">
                <strong>Fout!</strong> {{ $message }}
            </div>
        @endif
    </main>

    <!-- Main Content -->
    <main style="margin-top: 0; margin-bottom: 2rem;">
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer style="background: white; padding: 3rem 2rem; margin-top: 4rem; border-top: 1px solid #e5e7eb;">
        <div style="max-width: 1200px; margin: 0 auto; text-align: center; color: #6b7280;">
            <p>&copy; 2024 Windkracht-12 Kitesurf School. Alle rechten voorbehouden.</p>
            <p style="margin-top: 0.5rem; font-size: 0.9rem;">Professionele kitesurfles in Nederland</p>
        </div>
    </footer>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('African Retention Portal') }}</title>

    <!-- Meta tags and title -->


        <!-- Custom CSS -->
    {{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">--}}

    <!-- jQuery -->
    {{--    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>--}}
    <style>
        input,textarea,select {
            box-shadow: inset 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        /* Main container style */
        #container {
            margin-top: 1.5rem;
            border: 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
            padding: 1.5rem;
        }

        /* Button style */
        #container .btn {
            margin-bottom: 1rem;
        }

        /* Visitor Stats Styling */
        #visitorStats {
            margin: 1rem 0;
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .visitor-list {
            list-style: none;
            padding: 0;
        }

        .visitor-item {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem;
            border-bottom: 1px solid #eee;
        }

        .visitor-count {
            background-color: #4f46e5;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
        }

        .stat-item {
            font-size: 0.9rem;
        }
        @media (max-width: 768px) {
            .d-flex.justify-content-center.flex-wrap.gap-3 {
                justify-content: flex-start !important;
            }
        }
    </style>
    @php
        // Get visitor's IP
        $ip = Request::ip();

        // Only track if not already logged in session
        if (!Session::has('visitor_logged')) {
            try {
                // Get country info from IP using ipapi.co
                $countryData = json_decode(file_get_contents("https://ipapi.co/{$ip}/json/"), true);

                // Insert into database with IP and country info
                DB::table('visitor_stats')->insert([
                    'ip_address' => $ip,
                    'country_code' => $countryData['country_code'] ?? 'XX',
                    'country_name' => $countryData['country_name'] ?? 'Unknown',
                    'visited_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // Mark as logged in session
                Session::put('visitor_logged', true);

            } catch (\Exception $e) {
                // Log error silently
                \Log::error('Visitor tracking error: ' . $e->getMessage());

                // Insert with unknown country if API fails
                DB::table('visitor_stats')->insert([
                    'ip_address' => $ip,
                    'country_code' => 'XX',
                    'country_name' => 'Unknown',
                    'visited_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    @endphp


</head>

@extends('layouts.app')

<body id="app">
<div>
    @auth
        @include('menuTop')
        <div class="row">
            <div class="col-md-2">
                @include('menuAside')
            </div>
            <div class="col-md-9 px-md-4">
                @yield('content')
            </div>
        </div>
    @else
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-2">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('public.index') }}">
                    <i class="fas fa-book-reader"></i>
                    <span>African Retention</span>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-label="{{ __('toggle_navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">
                                <i class="fas fa-home"></i> {{ __('home') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url()->previous() }}">
                                <i class="fas fa-arrow-left"></i> {{ __('back') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('public.about')}}">
                                <i class="fas fa-info-circle"></i> {{ __('about') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('public.news') }}">
                                <i class="fas fa-newspaper"></i> {{ __('news') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('proposal.create') }}">
                                <i class="fas fa-plus"></i> Faire une proposition
                            </a>
                        </li>
                    </ul>
                </div>

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Sélecteur de langue -->
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="langDropdown" data-bs-toggle="dropdown">
                            {{ config('app.available_locales')[App::getLocale()] }}
                        </button>
                        <ul class="dropdown-menu">
                            @foreach(config('app.available_locales') as $locale => $label)
                                <li>
                                    <a class="dropdown-item @if(App::getLocale() == $locale) active @endif"
                                       href="{{ route('language.switch', $locale) }}">
                                        {{ $label }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Nous joindre') }}</a>
                    </li>
                </ul>
            </div>
        </nav>

        @if(isset($number_country) || isset($number_classes) || isset($number_rules) || isset($number_references) || isset($number_articles) || isset($number_typologies))
            <div class="container mb-3">
                <div class="bg-light py-2 px-3 rounded text-center">
                    <div class="d-flex justify-content-center flex-wrap gap-3">
                        @if(isset($number_country))
                            <div class="stat-item d-inline-flex align-items-center mx-2">
                                <i class="fas fa-globe me-2"></i>
                                <span>{{ __('statistics.countries') }}: <strong>{{ $number_country }}</strong></span>
                            </div>
                        @endif
                        @if(isset($number_classes))
                            <div class="stat-item d-inline-flex align-items-center mx-2">
                                <i class="fas fa-list-alt me-2"></i>
                                <span>{{ __('statistics.classifications') }}: <strong>{{ $number_classes }}</strong></span>
                            </div>
                        @endif
                        @if(isset($number_rules))
                            <div class="stat-item d-inline-flex align-items-center mx-2">
                                <i class="fas fa-gavel me-2"></i>
                                <span>{{ __('statistics.rules') }}: <strong>{{ $number_rules }}</strong></span>
                            </div>
                        @endif
                        @if(isset($number_references))
                            <div class="stat-item d-inline-flex align-items-center mx-2">
                                <i class="fas fa-book me-2"></i>
                                <span>{{ __('statistics.references') }}: <strong>{{ $number_references }}</strong></span>
                            </div>
                        @endif
                        @if(isset($number_articles))
                            <div class="stat-item d-inline-flex align-items-center mx-2">
                                <i class="fas fa-newspaper me-2"></i>
                                <span>{{ __('statistics.articles') }}: <strong>{{ $number_articles }}</strong></span>
                            </div>
                        @endif
                        @if(isset($number_typologies))
                            <div class="stat-item d-inline-flex align-items-center mx-2">
                                <i class="fas fa-th-list me-2"></i>
                                <span>{{ __('statistics.typologies') }}: <strong>{{ $number_typologies }}</strong></span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <div class="container">
            @yield('content')
        </div>
    @endauth
    <div class="row">
        @include('footer')
    </div>
</div>

</body>
</html>

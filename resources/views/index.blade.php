<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('African Retention Portal') }}</title>

    <!-- Meta tags and title -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

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

        /* Header style */
        #container h1, #container h2 {
            background-color: #0178d4;
            color: #fff;
            padding: 1rem;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
            margin-top: 0;
        }

        /* Button style */
        #container .btn {
            margin-bottom: 1rem;
        }

        /* Table style */
        #container .table {
            border: 1px solid #dee2e6;
        }

        #container .table th, #container .table td {
            border: 1px solid #dee2e6;
        }

        #container .table th {
            background-color: #f8f9fa;
        }

        #container .table tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

@extends('layouts.app')

<body id="app">
<div class="container-fluid">
    @auth
        @include('menuTop')
        <div class="row">
            <div class="col-2">
                @include('menuAside')
            </div>
            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
{{--                <a href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>--}}
                @yield('content')
            </div>
        </div>
    @else
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                    <i class="fas fa-book-reader"></i>
                    <span>African Retention</span>
                </a>

{{--                <div class="dropdown">--}}
{{--                    <button class="btn btn-secondary dropdown-toggle" type="button" id="langDropdown" data-bs-toggle="dropdown">--}}
{{--                        {{ config('app.available_locales')[App::getLocale()] }}--}}
{{--                    </button>--}}
{{--                    <ul class="dropdown-menu">--}}
{{--                        @foreach(config('app.available_locales') as $locale => $label)--}}
{{--                            <li>--}}
{{--                                <a class="dropdown-item @if(App::getLocale() == $locale) active @endif"--}}
{{--                                   href="{{ route('language.switch', $locale) }}">--}}
{{--                                    {{ $label }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </div>--}}
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-label="{{ __('toggle_navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">{{ __('about') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">{{ __('news') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary ml-2" href="{{ route('login') }}">{{ __('login') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="mb-3 px-4">
                {{-- Bouton Accueil avec icône maison --}}
                <a href="{{ url('/') }}" class="btn btn-primary me-2">
                    <i class="fas fa-home"></i> Accueil
                </a>

                {{-- Bouton Retour avec icône flèche --}}
                <a href="{{ url()->previous() }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>

            @yield('content')
        </div>
    @endauth
    <div class="row">
        @include('footer')
    </div>
</div>

<!-- Bootstrap Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

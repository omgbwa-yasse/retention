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
            <div class="col-md-9 ms-sm-auto  px-md-4">
{{--                <a href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>--}}
                @yield('content')
            </div>
        </div>
    @else
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
            <div class="container ">
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('public.index') }}">
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
                            <a class="nav-link" href="{{ route('public.about')}}">{{ __('about') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('public.news') }}">{{ __('news') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary ml-2" href="{{ route('login') }}">{{ __('login') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="">
                {{-- Bouton Accueil avec icône maison --}}
                <a href="{{ url('/') }}" class="btn btn-primary ">
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



</body>

</html>

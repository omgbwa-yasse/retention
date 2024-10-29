<!DOCTYPE html>
<html lang="en">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Retention') }}</title>
    <!-- Vos balises meta et title ici -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <!-- CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Votre CSS personnalisé -->
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">--}}

    <!-- Votre JS jquery -->
{{--    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>--}}
    <style>
        input,textarea,select {
            box-shadow: inset 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        /* Style pour le conteneur principal */
        #container {
            margin-top: 1.5rem;
            border: 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
            padding: 1.5rem;
        }

        /* Style pour l'en-tête */
        #container h1, #container h2 {
            background-color: #0178d4;
            color: #fff;
            padding: 1rem;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
            margin-top: 0;
        }

        /* Style pour les boutons */
        #container .btn {
            margin-bottom: 1rem;
        }

        /* Style pour la table */
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
                @yield('content')
            </div>
        </div>
    @else
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h4 class="mb-0">Portail africain des délais de conservation</h4>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">À propos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Nouveautés</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary ml-2" href="{{ route('login') }}">Connexion</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            @yield('content')
        </div>
    @endauth
    <div class="row">
        @include('footer')
    </div>
</div>

    <!-- Scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

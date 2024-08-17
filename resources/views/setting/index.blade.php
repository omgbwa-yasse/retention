@extends('index')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">{{ __('Paramètres') }}</h4>
                    </div>
                    <div class="card-body">
                        @if(auth()->check())
                            <div class="list-group">
                                <a href="{{ route('reference_categories.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    {{ __('Catégories de référence') }}
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                                <a href="{{ route('typology_categories.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    {{ __('Catégories de typologie') }}
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                                <a href="{{ route('country.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    {{ __('Pays') }}
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                                <a href="{{ route('triggers.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    {{ __('Declencheur') }}
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        @else
                            <div class="alert alert-info" role="alert">
                                <i class="fas fa-info-circle me-2"></i>
                                {{ __('Veuillez vous connecter pour accéder aux paramètres.') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

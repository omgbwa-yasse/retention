@extends('index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Settings') }}</div>

                    <div class="card-body">
                        @if(auth()->check())
                            <a href="{{ route('referenceCategory.index') }}" class="btn btn-block btn-secondary mb-3">{{ __('Reference Categories') }}</a>
                            <a href="{{ route('typologyCategory.index') }}" class="btn btn-block btn-secondary mb-3">{{ __('Typology Categories') }}</a>
                            <a href="{{ route('country.index') }}" class="btn btn-block btn-secondary mb-3">{{ __('Countries') }}</a>
                        @else
                            <p class="text-muted">{{ __('Please slog in to access the settings.') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

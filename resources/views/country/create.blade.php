@extends('index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="">
                <div class="card">
                    <div class="card-header">{{ __('Create Country') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('country.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="abbr" class="col-md-4 col-form-label text-md-right">{{ __('Abbreviation') }}</label>

                                <div class="col-md-6">
                                    <input id="abbr" type="text" class="form-control @error('abbr') is-invalid @enderror" name="abbr" value="{{ old('abbr') }}" required autocomplete="abbr" autofocus>

                                    @error('abbr')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Creer ') }}
                                    </button>
                                    <a href="{{ route('country.index') }}" class="btn btn-secondary">
                                        {{ __('Annuller') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

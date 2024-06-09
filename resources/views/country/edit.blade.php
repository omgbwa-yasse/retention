@extends('index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Country') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('country.update', $country->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="abbr" class="col-md-4 col-form-label text-md-right">{{ __('Abbreviation') }}</label>

                                <div class="col-md-6">
                                    <input id="abbr" type="text" class="form-control @error('abbr') is-invalid @enderror" name="abbr" value="{{ $country->abbr }}" required autocomplete="abbr" autofocus>

                                    @error('abbr')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
    @enderror

@extends('index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Modifier la catégorie de typologie') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('typology_categories.update', $typologyCategory->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $typologyCategory->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" autocomplete="description">{{ $typologyCategory->description }}</textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="parent_id" class="col-md-4 col-form-label text-md-right">{{ __('Catégorie parente') }}</label>

                                <div class="col-md-6">
                                    <select id="parent_id" class="form-control @error('parent_id') is-invalid @enderror" name="parent_id" autocomplete="parent_id">
                                        <option value="">{{ __('Aucune catégorie parente') }}</option>
                                        @foreach ($typologyCategories as $category)
                                            <option value="{{ $category->id }}" @if($typologyCategory->parent_id == $category->id) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('parent_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Mettre à jour') }}
                                    </button>
                                    <a href="{{ route('typology_categories.index') }}" class="btn btn-secondary">
                                        {{ __('Annuler') }}
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

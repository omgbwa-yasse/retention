<!-- resources/views/references/edit.blade.php -->

@extends('index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Modifier la référence</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('reference.update', $reference->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="title">Titre</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $reference->title) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control">{{ old('description', $reference->description) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="category_id">Catégorie</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="">Sélectionnez une catégorie</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $reference->category_id == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="files">Fichiers</label>
                                <input type="file" name="files[]" id="files" class="form-control-file" multiple>
                            </div>

                            <div class="form-group">
                                <label for="links">Liens</label>
                                @foreach($reference->links as $link)
                                    <input type="text" name="links[{{ $link->id }}][title]" value="{{ $link->title }}" placeholder="Titre du lien" class="form-control mb-2">
                                    <input type="url" name="links[{{ $link->id }}][url]" value="{{ $link->link }}" placeholder="URL" class="form-control">
                                @endforeach
                            </div>

                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

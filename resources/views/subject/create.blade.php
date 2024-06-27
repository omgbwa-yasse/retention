@extends('index')
@section('content')
<h1>Ajouter un sujet</h1>
        <form action="{{ route('subject.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nom:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Classification</label>
                <select class="form-select form-select-lg" name="class_id" id="" >
                    @foreach($classes as $classe)
                        <option value="{{ $classe->id }}">{{ $classe->code }} - {{ $classe->name }}</option>
                    @endforeach
                </select>
            </div>


            <button type="submit" class="btn btn-primary">Creer</button>
            <button type="reset" class="btn btn-primary">Annuler</button>
        </form>



@endsection

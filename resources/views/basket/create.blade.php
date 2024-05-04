@extends('index')

@section('content')
<h1>Ajouter un panier</h1>
<form action="{{ route('basket.store') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label for="name" class="form-label">Nom</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
  </div>
  <div class="mb-3">
    <label for="type_id" class="form-label">Type de panier</label>
    <select name="type_id" id="type_id" class="form-select">
      <option value="">Sélectionnez un type de panier</option>
      @foreach ($basketTypes as $basketType)
        <option value="{{ $basketType->id }}">{{ $basketType->name }}</option>
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Créer</button>
</form>

@endsection

@extends('index')

@section('content')

  <div class="container">
    <h1>Voir un Panier</h1>

    <a href="{{ route('basket.index') }}" class="btn btn-primary">Retour vers la liste</a>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Attribut</th>
          <th>Valeur</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Nom</td>
          <td>{{ $basket->name }}</td>
        </tr>
        <tr>
          <td>Description</td>
          <td>{{ $basket->description }}</td>
        </tr>
        <tr>
          <td>Type de Panier</td>
          <td>{{ $basket->type->name ?? 'Aucun type' }}</td>
        </tr>

        <!--


                Ici, selon le type, je parcours les donnees avec case


        -->

      </tbody>
    </table>

    <a href="{{ route('basket.edit', $basket) }}" class="btn btn-info">Modifier</a>
    <form action="{{ route('basket.destroy', $basket) }}" method="POST" class="d-inline">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this basket?')">Supprimer</button>
    </form>
  </div>

@endsection

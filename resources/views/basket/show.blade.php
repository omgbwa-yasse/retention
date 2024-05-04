@extends('index')

@section('content')

  <div class="container">
    <h1>Show Basket</h1>

    <a href="{{ route('basket.index') }}" class="btn btn-primary">Back to List</a>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Attribute</th>
          <th>Value</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Name</td>
          <td>{{ $basket->name }}</td>
        </tr>
        <tr>
          <td>Description</td>
          <td>{{ $basket->description }}</td>
        </tr>
        <tr>
          <td>Basket Type</td>
          <td>{{ $basket->type->name ?? 'Aucun type' }}</td>
        </tr>

        <!--


                Ici, selon le type, je parcours les donnees avec case


        -->

      </tbody>
    </table>

    <a href="{{ route('basket.edit', $basket) }}" class="btn btn-info">Edit</a>
    <form action="{{ route('basket.destroy', $basket) }}" method="POST" class="d-inline">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this basket?')">Delete</button>
    </form>
  </div>

@endsection

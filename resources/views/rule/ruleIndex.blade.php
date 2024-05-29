<!-- index.blade.php -->

@extends('index')

@section('content')
    <div class="container">
        <h1>Règles de conservation </h1>
        <a href="{{ route('rule.create') }}" class="btn btn-success mb-2">Ajouter</a>
        <a href="" class="btn btn-grey mb-2">Imprimer</a>
        <a href="" class="btn btn-grey mb-2">Exporter</a>
        <a href="" class="btn btn-grey mb-2">Panier</a>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th scope="col">code</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Statut</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($rules as $rule)
                <tr>
                    <th scope="row">{{ $rule->code }}</th>
                    <td>{{ $rule->name }}</td>
                    <td> {{ $rule->description }} </td>
                    <td>
                        @php
                            $statusClass = '';
                            if ($rule->status->name == 'En examen') {
                                $statusClass = 'badge-success';
                            } elseif ($rule->status->name == 'Projet') {
                                $statusClass = 'badge-primary';
                            } elseif ($rule->status->name == 'Acceptée') {
                                $statusClass = 'badge-info'; // You can change 'badge-info' to any color you prefer
                            }
                        @endphp
                        <span class="badge {{ $statusClass }}">{{ $rule->status->name }}</span>
                    </td>
                    <td>
                        <a href="{{ route('rule.show', $rule->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('rule.edit', $rule->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('rule.destroy', $rule->id) }}" method="POST"
                              style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

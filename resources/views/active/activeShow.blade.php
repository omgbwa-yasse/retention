@extends('index')

@section('content')
<h1>Active #{{ $active->id }}</h1>

<p><strong>Duration:</strong> {{ $active->duration }}</p>
<p><strong>Description:</strong> {{ $active->description }}</p>

<h2>Rule</h2>
<p><strong>Name:</strong> {{ $active->rule->name }}</p>
<p><strong>Description:</strong> {{ $active->rule->description }}</p>

<h2>Trigger</h2>
<p><strong>Name:</strong> {{ $active->trigger->name }}</p>
<p><strong>Description:</strong> {{ $active->trigger->description }}</p>

<h2>Sort</h2>
<p><strong>Name:</strong> {{ $active->sort->name }}</p>
<p><strong>Description:</strong> {{ $active->sort->description }}</p>

<a href="{{ route('active.index') }}" class="btn btn-primary">Back to all actives</a>
@endsection

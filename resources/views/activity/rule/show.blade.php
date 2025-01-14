@extends('index')

@section('content')

<h1>Rule {{ $rule->name }} for Classification {{ $activity->name }}</h1>

<p>{{ $rule->description }}</p>

@endsection



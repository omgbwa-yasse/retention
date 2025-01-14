@extends('index')

@section('content')

<h1>Rule {{ $rule->name }} for Classification {{ $classification->name }}</h1>

<p>{{ $rule->description }}</p>

@endsection



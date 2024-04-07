@extends('index')

@section('content')
    <h1>{{ $reference->title }}</h1>
    <p>Description: {{ $reference->description }}</p>
    <p>Category: {{ $reference->category->title }}</p>
    <a href="{{ route('reference.index') }}" class="btn btn-primary">Back</a>
@endsection

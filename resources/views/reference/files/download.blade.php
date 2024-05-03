@extends('index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Download File</h1>
            <p><a href="{{ Storage::url($file->file_path) }}">{{ $file->name }}</a></p>
        </div>
    </div>
</div>
@endsection

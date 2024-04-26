@extends('index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $file->name }}</h1>
            <p><a href="{{ Storage::url($file->file_path) }}" target="_blank">Download File</a></p>
            <a href="{{ route('reference.file.edit', [$reference, $file]) }}" class="btn btn-secondary">Edit</a>
            <form action="{{ route('reference.file.destroy', [$reference, $file]) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection

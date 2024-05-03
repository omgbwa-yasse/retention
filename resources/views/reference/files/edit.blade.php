@extends('index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Edit File for {{ $reference->name }}</h1>
            <form action="{{ route('reference.file.update', [$reference, $file]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $file->name }}" required>
                </div>
                <div class="form-group">
                    <label for="file">File</label>
                    <input type="file" name="file" id="file" class="form-control-file">
                </div>
                <button type="submit" class="btn btn-primary">Update File</button>
            </form>
        </div>
    </div>
</div>
@endsection
